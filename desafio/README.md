# Para hoje

- [x] Estamos no meio do caminho, temos que acostumar com mudanças
- [x] dotEnv - development (debug) - production (online)
- [x] Twig
- [x] Adequar novo formato com view em Trilhas
  - [x] Mover requires das classes para setup (ainda não é definitivo)
  - [x] Injetar conteúdo na view
- [x] CRUD completo da Trilha
- [x] Listar Desafios da trilha
  - [x] CRUD completo da fase 
  
- [ ] Cada um atualizar seus códigos e deixar seus CRUDs funcionando
- [ ] Alguem procurar como implementar autenticação nesse admin
- [ ] Alguem fazer a view da raiz / exibindo uma lista de trilhas para o usuário seguir

# Próximas melhorias

- Controller: mover códigos do index.php para controllers. Cada grupo, será um controller.
- Model: tornar o acesso aos dados mais "limpo" nas classes model

# Enviroment (.env)

Para rodar o projeto localmente em sua máquina, é preciso ter um aquivo .env, que será onde ficarão os parametros de conexão com banco de dados e outras informações sensíveis.

Crie um arquivo ```.env``` na raiz de /desafio/. Este arquivo não será commitado, pois está no gitignore (e deve continuar lá). O conteúdo dele precisa ter ao menos:

```
# Dados dde conexão com banco de dados
db_host=IP_DO_SERVIDOR
db_post=3306
db_name=nome_do_database
db_user=username_conexao
db_password=password_conexao

# Indica se estamos em ambiente de desenvolvimento
env_debug=true
```

Uma vez que este arquivo esteja na raiz do projeto, o script tentará conexão com o banco de dados, e seguirá seu caminho.

[Saber mais sobre o dotEnv](https://github.com/vlucas/phpdotenv)
