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


# Novas rotas

```
/admin/trilha/ - lista as trilhas   

/admin/trilha/2/editar/ - edita a trilha 2
/admin/trilha/2/excluir/ - apaga a trilha 2
/admin/trilha/2/fase/ - exibe as fases da trilha 2
/admin/trilha/2/fase-incluir/ - inclui uma nova fase na trilha 2   

/admin/fase/4/editar/ - edita a fase 4
/admin/fase/4/excluir/ - apaga a fase 4
/admin/fase/4/pergunta/ - exibe as perguntas da fase 4
/admin/fase/4/pergunta-incluir/ - inclui uma nova pergunta na fase 4   

/admin/pergunta/20/editar/ - edita a pergunta 20
/admin/pergunta/20/excluir/ - apaga a pergunta 20
/admin/pergunta/20/opcao/ - exibe as opções da pergunta 20
/admin/pergunta/20/opcao-incluir/ - inclui uma nova opcao na pergunta 20   

/admin/opcao/3/editar/ - edita a opcao 3
/admin/opcao/3/excluir/ - apaga a opcao 3
```

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
