set PROJECT;
set STUDENT;

param cost {STUDENT,PROJECT} >= 0, default Infinity; #coût associé aux voeux
param Cmin {PROJECT} >= 0; #capacité min d'un projet
param Cmax {j in PROJECT} >= Cmin[j]; #capcité max d'un projet

# --------------------------------------------------------

var Affect {STUDENT, PROJECT} >= 0, <= 1, integer; #1 pour étudiant i affecté à projet j, 0 sinon
var StudentInProject {j in PROJECT} >= Cmin[j], <= Cmax[j], integer; #capacité projet comprise entre Cmin et Cmax

# --------------------------------------------------------

minimize Total_Cost:  sum {i in STUDENT, j in PROJECT} cost[i,j] * Affect[i,j];

# --------------------------------------------------------

subject to every_student_is_affected {i in STUDENT}:
	sum {j in PROJECT} Affect[i,j] = 1;

subject to balance {j in PROJECT}:
	sum {i in STUDENT} Affect[i,j] = StudentInProject[j];

