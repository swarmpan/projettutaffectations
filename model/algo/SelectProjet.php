<?php

require_once ('ProjetRanking.php');
require_once('GrapheAffectation.php');

class SelectProjet 
{

    public $projetsInit;
	public $projects;
	public $capacite;
    public $capaciteTotale;
	public $projSelectionnables;
    public $nbEtudiants;
    public $recherche;
    public $projetsToSort;
    public $projetsSorted;

	public function __construct()
    {
    	$this->capacite = 0;
        $this->capaciteTotale = 0;
        $this->nbEtudiants = 0;
        $this->projetsInit = array();
        $this->projects = array();
        $this->projSelectionnables = array();
        $this->recherche = true;
        $this->projetsToSort = array();
        $this->projetsSorted = array();

        $this->calculCapaciteMinProjets();

        if($this->recherche)
        {
            $this->supProjectVide();
        }

        if ($this->recherche)
            $this->selectProjetRank1();

        if ($this->recherche)
        {
            $this->sortProjet();
            $this->supProject();
        }

    }


    public function getListeProjets() {
        return $this->projects;
    }

    public function calculCapaciteMinProjets(GrapheAffectation $g) {
        $capacite;
        $this->nbEtudiants = count($g->getArrayEtudiants());
        $projets = $g->getArrayProjets();
        foreach ($projets as $project) {
            $this->projetsInit[] = $project;
            $capacite += $project->getMin();
        }
        if ($capacite <= $this->nbEtudiants) {
            $this->recherche = false;
        }
        else 
            $this->capaciteTotale = $capacite;
    }


    public function supProjectVide()
    {
        foreach ($this->projetsInit as $project) {
            if ($this->capaciteTotale <= $this->nbEtudiants) {
                $this->recherche = false;
            }
            else {
                if ($project->getTotal() >= $project->getMin()) 
                {
                    $this->projSelectionnables[] = $project;
                }
                else
                    $this->capaciteTotale -= $project->getMin();
            }
        }

    }

    public function selectProjetRank1() 
    {
    	foreach ($projSelectionnables as $project) {

    		$nbDemande1 = $project->getNbRanking1();
    		$min = $project->getMin();
    		$max = $project->getMax();

    		if ($min <= $nbDemande1 && $nbDemande1 <= $max && $this->capacite < $this->nbEtudiants) {

    			$this->projects[] = $project;
    			$this->capacite += $nbDemande1;

    			try {
					$req = Model::$pdo->prepare("SELECT * FROM project_ranking WHERE id_project = ? and ranking = ?");
		  			$req->execute(array($idProject, 1));
		  			$req->setFetchMode(PDO::FETCH_CLASS, 'Etudiant');
		  			$liste = $req->Fetch();
				} 
				catch(PDOException $e) {
					Model::theCatch($e->getMessage());
				}

				foreach ($liste as $etudiant) {
					$g->affecterVoeu($etudiant, $project, 1);
				}
    		}
            elseif ($min <= $nbDemande1 && $this->capacite < $this->nbEtudiants) {
                $this->projects[] = $project;
                $this->capacite += $nbDemande1;
            }
    		elseif ($this->capacite >= $this->nbEtudiants)
                $this->recherche = false;
            else
    			$this->projetsToSort[] = $project;
    	}
    }

    


function Compare($arg1, $arg2) 
{ 
   if ($arg1[1]<=$arg2[1] && arg1[2]<=arg2[2]) 
      return -1; 
   else if ($arg1[1]>$arg2[1] && arg1[2]>arg2[2]) 
      return 1; 
   else 
        $diff1 = abs(arg1[2]-arg1[1]);
        $diff2 = abs(arg2[2]-arg2[1]);
        if ($diff1<=$diff2)
            return -1;
        else
            return 1;
} 



    public function sortProjet() {

    	foreach ($this->projetsToSort as $p) {
    		$this->projetsSorted[] = array($p, $p->getMoyenne(), $p->getM());
    	}
        usort($this->projetsSorted, "Compare");

    }


    public function supProject()
    {
        while ($this->recherche) {
            $element = array_pop($this->projetsSorted);
            $capaciteTotale -= $element[0]->getMin();
            if ($this->capaciteTotale <= $this->nbEtudiants) {
                $this->recherche = false;
            }
        }
        foreach ($this->projetsSorted as $p) {
            $projects[] = $p[0];
        }
    }

}
