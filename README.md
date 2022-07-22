# CMS
A CMS developed from scratch

## design pattern

### singleton 
  - CMS/www/Core/BaseSQL.class.php 
    - ligne 42
    - pour eviter les multiples connexion à la de données 

### Query Builder 
  - CMS/www/Core/Query.class.php 
    - pour generer des requetes preparées.
  
 ### fasade 
  - CMS/www/Core/Query.class.php 
    - ligne 27
    - pour facilité l'utilisation du query builder .
  
### Observer 
  - CMS/www/Controller/Newsletterengine.class.php 
    - ligne 140
    - permet d'envoyer les newsletters à tous les utilisateurs.
  
  

  
