# Conexão com o banco de dados e outros dados secretos

Quando você tem um servidor online, e precisa se conectar via PHP com ele, a primeira coisa que faz é informar o host name, login e password no arquivo de conexão com o banco de dados.

Porém, em um projeto open source, ou onde cada programador terá seu próprio banco, não seria tão prático ter estes parametros diretamente na classe, porque cada desenvolvedor iria "fatalmente" edita-lo e depois commita-lo. Além do que, ter seu login e senha de conexão com o banco de dados, exposto, de forma pública, não é nada legal.

Como resolver isso então?

Existem duas maneiras. 

# A mais simples

- Adicione ao seu gitignore uma linha com ``secret.php``
- Crie este arquivo (secret.php) na pasta de seu projeto
- Mova para dentro do secret.php os parametros de conexão com o banco de dados, e tudo mais que não pode ser público
- Na sua classe de conexão, carregue este arquivo, obtenha as configurações e siga em frente
- Caso alguém baixe o projeto, na linha onde o secret é carregado o código irá falhar
- Para a pessoa usar, ela terá que criar o proprio secret.php, nos moldes que você informar

# A mais bem feita

É semelhante ao anterior, porem mais bem feito.

- Adicione ao seu gitignore uma linha com ``.env``
- Crie este arquivo (.env) na pasta de seu projeto
- Instale o [dotEnv](https://github.com/vlucas/phpdotenv) para PHP
- Obtenha os parametros de conexão com o banco via getenv ou $_ENV e siga em frente

# Resumindo

Nos dois casos o arquivo que tem os dados sensíveis, não irá para o repositório, porque foi incluído no .gitignore. Recomendo que você tenha em seu readme um exemplo de como o arquivo deve ser escrito e quais valores são necessários, tal como [este readme](https://github.com/TiagoGouvea/curso-php-2018/blob/master/desafio/README.md).
