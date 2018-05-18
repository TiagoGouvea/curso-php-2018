



Usuario entra no desafio
Trilha - aprendizado
Uma trilha tem várias Fases/Desafio
Uma fase tem um texto, e tem um questionário (com várias perguntas)

# Banco de dados

Tabelas:
- Usuario
- Trilha - Geronimo
- Desafio/Fase - Leonardo
- Questionario/Perguntas - Guilherme
- Opção - Bernando

# Implementar

CRUD completo da tabela: 
- Listar registros
- Incluir registro
- Excluir registro
- Editar registro

Recomendo: 
- Usar Bootstrap

1 - Criar pasta com nome da tabela ex: "trila"
2 - Criar um index.php que terá link para as opções
3 - Criar um form.php que é o formulário
4 - Criar um add.php que carrega o formulário, e salva no banco (inserindo)
5 - Criar objeto que conecta com banco e executa as queries
6 - Criar um list.php que lista os registros do banco
7 - Carregar o list.php no index.php, pra já listar os registros
8 - Criar um edit.php que carrega o formulário, exibindo um registro, e salva as alteração (editando)
9 - Criar um del.php ou index.php?del=[id] que apaga um registro

# Servidor online

ServerName: desafio-php

### MySql
Usuário: root   
Senha: TiagoGouvea

'client'@'%' IDENTIFIED BY 'TiagoGouvea';

### PhpMyAdmin

http://167.99.233.184/phpmyadmin/

Usuário: phpmyadmin
Senha:  TiagoGouvea