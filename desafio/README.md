# Enviroment (.env)

Para rodar o projeto localmente em sua máquina, é preciso ter um aquivo .env, que será onde ficarão os parametros de conexão com banco de dados e outras informações sensíveis.

Crie um arquivo ```.env``` na raiz de /desafio/. Este arquivo não será commitado, pois está no gitignore (e deve continuar lá). O conteúdo dele precisa ter ao menos:

```
# Dados dde conexão com banco de dados
db_host=167.99.IP_DO_SERVIDOR.184
db_post=3306
db_name=nome_do_database
db_user=username_conexao
db_password=password_conexao

# Indica se estamos em ambiente de desenvolvimento
env_debug=true
```

Uma vez que este arquivo esteja na raiz do projeto, o script tentará conexão com o banco de dados, e seguirá seu caminho.

[Saber mais sobre o dotEnv](https://github.com/vlucas/phpdotenv)
