/*Stat client par sousfam*/
SELECT idsfam, codeclt, round(sum(vte_fact),2) as chiffre,
MONTH(datedoc) as MONTH, YEAR(datedoc) as YEAR from ventes
Where codeclt=input_codelct and idsfam=input_idsfam
group by idsfam, input_date;
/*Stat client par fam*/
SELECT sousfamille.idfam, codeclt, round(sum(vte_fact),2) as chiffre,
MONTH(datedoc) as MONTH, YEAR(datedoc) as YEAR from ventes,sousfamille
Where codeclt=input_codelct and sousfamille.idfam=input_idfam
and ventes.idsfam=sousfamille.idsfam
group by idsfam, input_date;

/*stat client top 3*/
/*par famille*/
SELECT sousfamille.idfam, codeclt, round(sum(vte_fact),2) as chiffre,
YEAR(datedoc) as YEAR from ventes,sousfamille
Where codeclt=input_codelct and ventes.idsfam=sousfamille.idsfam
group by sousfamille.idfam, YEAR order by chiffre desc limit 0,3;

/*par sousfamille */
SELECT idsfam, codeclt, round(sum(vte_fact),2) as chiffre,
YEAR(datedoc) as YEAR from ventes,sousfamille
Where codeclt=input_codelct
group by idsfam, YEAR order by chiffre desc limit 0,3;

/*Stat representant*/
/*par sousfamille avec marge*/
SELECT idsfam, codeclt, round(sum(vte_fact),2) as chiffre,
MONTH(datedoc) as MONTH, YEAR(datedoc) as YEAR,
round(AVG(marge),2) as marge from ventes
Where coderep=input_coderep and codeclt=input_codeclt and idsfam=input_idsfam
group by codeclt, idsfam, input_date;

/*par famille avec marge*/
SELECT sousfamille.idfam, codeclt, round(sum(vte_fact),2) as chiffre,
MONTH(datedoc) as MONTH, YEAR(datedoc) as YEAR,
round(AVG(marge),2) as marge from ventes,sousfamille
Where coderep=input_coderep and codeclt=input_codelct and sousfamille.idfam=input_idfam
and ventes.idsfam=sousfamille.idsfam
group by codeclt, idfam, input_date;

/*affichage top3 sousfamille */
SELECT idsfam, codeclt, round(sum(vte_fact),2) as chiffre,
MONTH(datedoc) as MONTH, YEAR(datedoc) as YEAR from ventes
Where coderep=input_coderep and idsfam=input_idsfam
group by codeclt, idsfam, YEAR
order by chiffre desc limit 0,3;

/*affichage top 3 par famille*/
SELECT sousfamille.idfam, codeclt, round(sum(vte_fact),2) as chiffre,
MONTH(datedoc) as MONTH, YEAR(datedoc) as YEAR
from ventes,sousfamille
Where coderep=input_coderep and sousfamille.idfam=input_idfam
and ventes.idsfam=sousfamille.idsfam
group by codeclt, idfam, YEAR
order by chiffre desc limit 0,3;

/*CA et marge globale*/
SELECT round(sum(vte_fact),2) as chiffre,
MONTH(datedoc) as MONTH, YEAR(datedoc) as YEAR,
round(AVG(marge),2) as marge
from ventes
where coderep=input_coderep
group by coderep, input_date;
