# Twitter Clone v1.1.0

Bem-vindo ao projeto **Twitter Clone**! Este é um clone da antiga rede social Twitter, desenvolvido utilizando PHP e JavaScript, seguindo o padrão MVC (Model-View-Controller). O objetivo deste projeto é fornecer uma compreensão básica de como funcionam aplicações web dinâmicas.

https://github.com/user-attachments/assets/7b3ba79c-de25-488b-9aed-fc4736bbebf6

## Funcionalidades

- Cadastro de usuários
- Login e autenticação
- Publicação de tweets
- Feed de tweets
- **Novo!** Feed com registros paginados (Adicionado na versão 1.1.0)

## Requisitos

- PHP 7.0 ou superior
- Servidor web (Apache ou Nginx)
- Banco de dados MySQL
- Extensões PHP: PDO, session

## Configuração do Ambiente

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/seu-usuario/twitter-clone.git
   ```

2. **Crie o Banco de Dados:**

   O arquivo `create_database.sql` contém os comandos necessários para criar o banco de dados e as tabelas. Execute o script no seu servidor MySQL:

3. **Configuração da Conexão com o Banco de Dados:**

   Edite o arquivo `Connection.php` para ajustar as configurações de conexão (se necessário):

## Estrutura do Projeto

- **app/**
  - `Controllers/` - Controladores da aplicação
  - `Models/` - Modelos de dados
  - `Views/` - Arquivos de visualização (HTML/PHP)
  
- **public/**
  - `index.php` - Ponto de entrada da aplicação
  - `css/` - Arquivos CSS
  - `img/` - Arquivos JavaScript

## Como Executar

1. **Inicie o servidor web.**
2. **Acesse o projeto pelo navegador:**  
   `http://localhost/twitter-clone/public`

## Contribuição

Se você deseja contribuir com este projeto, sinta-se à vontade para enviar um pull request ou abrir uma issue para discussões.

## Licença

Este projeto está licenciado sob a MIT License - veja o arquivo [LICENSE](LICENSE) para mais detalhes.
---

Sinta-se à vontade para personalizar este README conforme necessário!
