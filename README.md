# Scrum Project - IT-B2-23

## Getting started

### Requirements
Before starting development, some requirements need to be fulfilled for this project to work properly:

- [Docker engine (CLI)](https://docs.docker.com/engine/install/)
- [Docker compose](https://docs.docker.com/compose/install/)

In order to start contributing to this project, first clone the repository to your machine by running the following command in your desired directory through the terminal:
```shell
git clone https://github.com/JoseEscauriza/Scrum_Project.git
```

Once cloned, run:
```shell
docker compose up -d --build
```

This will initiate 4 different containers necessary for the project.

### Tools available

In order to facilitate development and debugging, some scripts are available under /tools  
Please ensure they are executable by running the following command in your terminal:
```shell
sudo chmod +x ./tools/*
```
The scripts in detail:
#### - exec.sh
Provides direct access to the scrum-app container

#### - exec_ollama.sh
Provides direct access to the ollama-scrum container

#### - pull_model.sh
Provides an easy way of pulling different models into the ollama-scrum container.
It takes one argument, which is the model to be pulled. The following command would pull the llama3.2 model
```shell
./tools/pull_model.sh llama3.2
```

#### Creating your own model
In order to create our own model, use the available Modelfile, located inside the models directory.
Said file is being mounted into ``` - ./models:/root/.ollama/models```, as defined in the docker-compose.yml file.

Use the exec_ollama.sh script to access the running ollama container, and once there, run the following command:
```shell
ollama create wheely -f ./root/.ollama.models
```

Running the project in its default state requires running the previous command, since index.php includes a prompt using the custom wheely model.

#### Compose
Finally, in order to install some needed dependencies, run:
```shell
composer install
```

And finish up by running the following command, to ensure all containers are running and up to date:
```shell
docker compose up -d
```

### Available routes

You now have access to two different sites by entering the following addresses in your browser of choice:
- Index.php [http://localhost:8080](http://localhost:8080)
- PhpMyAdmin dashboard [http://localhost:8081](http://localhost:8081)
