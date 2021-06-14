# reservApp

This App By Development with VueJs and Laravel and has made with Docker

## Requirements

You need install docker and docker compose.

    docker: https://docs.docker.com/get-docker/
    docker composer: https://docs.docker.com/compose/install/ 

## Step to run this app
1. Clone this repository and go to the root of the project
2. Execute on terminal 
```docker-compose up -d```
3. Wait for the instalation to finish.
4. Find container id of reserv-app_backend container. CMD: ```docker ps```
5. Execute this CMD for migrate: ```docker exec -it <container_id> php artisan migrate:refresh --seed```
6. Ready !!!, click on this link: http://localhost:8080/  and you can see the front app running.
