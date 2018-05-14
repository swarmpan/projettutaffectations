<?php

require_once ('Sommet.php');
require_once('Model.php');


class ProjetRanking extends Projet
{
	public $idProject;
	public $moyenne;
	public $m;
	public $demandePerRanking;
	public $demandeTotal;
	public $nbRanking;

	public function __construct($id, $nbRank) 
	{
		parent::__construct();
		$this->idProject = id;
		$this->moyenne = 0;
		$this->m = 0;
		$this->nbRanking = nbRank;
		$this->demandePerRanking = array();
		$this->demandeTotal = 0;
		$this->calculNbDemande();
		$this->calculM();
		$this->calculMoyenne();
		$this->calculTotal();

	}

	public function getNbRanking1() 
	{
		return $this->demandePerRanking[1];
	}

	public function getMoyenne() 
	{
		return $this->moyenne;
	}

	public function getM()
	{
		return $this->m;
	}

	public function getTotal()
	{
		return $this->demandeTotal;
	}


	public function calculNbDemande()
	{
		$demande;
		for ($ranking = 1; $ranking <= nbRanking; $ranking++)
		{
			//$demandeRanking = 0;
 			$demande = Model::$pdo->prepare('SELECT COUNT(*) as nbPerRank FROM project_ranking WHERE id_project = ? and ranking = ?');
 			$demande->execute(array($idProject, 1));
 			$demandeRanking = $demande->Fetch();
 			$this->demandePerRanking[$ranking] = $demandeRanking['nbPerRank'];
 			/*$demandeRanking=$bdd->query(SELECT * FROM project_ranking WHERE id_project=idProject and ranking=1); 
			while($arrayDemande = $demande[$ranking]->fetch()) 
				$demandeRanking++;
			$this->demandePerRanking[$ranking] = demandeRanking;*/
		}
	}


	public function calculMoyenne()
	{
		$total = 0;
		$average = 0;
		for ($ranking = 1; $ranking <= nbRanking; $ranking++)
		{
			$total += $this->demandePerRanking[$ranking];
			$average += $ranking * $this->demandePerRanking[$ranking];
		}
		$this->moyenne = $average/$total;
	}

	public function calculM()
	{
		$rank = 0;
		$nbRank = 0;
		for ($ranking = 1; $ranking <= nbRanking; $ranking++)
		{
			if ($nbRank > $this->demandePerRanking[$ranking])
			{
				$rank = $ranking;
				$nbRank = $this->demandePerRanking[$ranking];
			}
		}
		$this->m = $rank;
	}

	public function calculTotal() 
	{
		for ($ranking = 1; $ranking <= nbRanking; $ranking++)
		{
			$this->total += demandePerRanking[$ranking];
		}
	}
}
