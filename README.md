# Parcourir le projet

Chaque bundle que nous avons vu est isolé sur une branche git
différente.

Afin de mettre en place l'environnement nécessaire, il y a un
`Makefile` avec des commandes.

Chacune des commandes qui nous intéresse aura pour effet de changer
la branche courante et d'installer les dépendances nécessaire.

### Liste des commandes
- `make sonata` pour sonata admin
- `make easy` pour easy admin
- `make migrations` pour doctrine migrations
- `make uploader` pour l'upload de fichier et la manipulation des images
- `make user` pour FOSUser
- `make alice` pour les fixtures avec AliceBundle et Faker (pas vu ensemble, mais vous pouvez toujours jeter un oeil)

### Structure
Pour chaque branche, j'ai divisé en commit la mise en place du 
bundle et des étapes que l'on a vu.

Vous pouves naviguer dans les commit avec la commande 
`git checkout <hash_du_commit>`

Puis faire un `make diff`, pour voir seulement les modifications que j'ai effectué
