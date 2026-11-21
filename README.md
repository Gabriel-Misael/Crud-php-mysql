# CRUD PHP + MySQL (Livraria)

Projeto de estudo em PHP puro que usa **PDO** para executar um CRUD completo (criar, ler, atualizar e deletar) em um banco MySQL local, rodando pelo XAMPP.

O tema é uma **livraria**: o banco `livraria` guarda a tabela `livro` com nome, autor e editora.

## Tecnologias

- PHP (PDO)
- MySQL
- XAMPP (Apache + MySQL)

## Como rodar

1. Instale o [XAMPP](https://www.apachefriends.org) e inicie o **Apache** e o **MySQL** no painel.
2. Copie a pasta do projeto para `C:\xampp\htdocs\`.
3. Confira as credenciais em `config.php` (padrão do XAMPP: usuário `root`, senha vazia).
4. Acesse os arquivos pelo navegador, nesta ordem:

| Ordem | URL | O que faz |
|---|---|---|
| 1 | `http://localhost/<pasta>/teste.php` | Testa a conexão com o MySQL |
| 2 | `http://localhost/<pasta>/criarbanco.php` | Cria o banco `livraria` |
| 3 | `http://localhost/<pasta>/criartabela.php` | Cria a tabela `livro` |
| 4 | `http://localhost/<pasta>/create.php` | Insere 8 livros na tabela |
| 5 | `http://localhost/<pasta>/read.php` | Lista os livros em uma tabela HTML |
| 6 | `http://localhost/<pasta>/update.php` | Corrige o autor de *Morte e Vida Severina* |
| 7 | `http://localhost/<pasta>/delete.php?id=1` | Exclui o livro com o id informado |

> Dica: na página do `read.php` cada linha tem um link **Excluir** que já chama o `delete.php` com o id certo.

## Fluxo

Cada arquivo `.php` executa **uma operação** quando é aberto no navegador.

1. `config.php` define as variáveis de conexão (servidor, usuário, senha e nome do banco).
2. Cada script faz `require_once 'config.php'` e abre uma conexão com `new PDO(...)`.
3. O PDO é configurado para lançar exceções (`ERRMODE_EXCEPTION`) e o SQL roda dentro de um `try/catch`.
4. O resultado (sucesso, dados listados ou mensagem de erro) aparece na tela e a conexão é fechada (`$conexao = null`).

```
teste.php → criarbanco.php → criartabela.php → create.php → read.php ⇄ delete.php?id=N
                                                                  update.php
```

## Estrutura do banco

Banco: `livraria`

Tabela: `livro`

| Coluna | Tipo | Restrições |
|---|---|---|
| `id` | `INT` | Chave primária, `AUTO_INCREMENT` |
| `nome` | `VARCHAR(30)` | `NOT NULL` |
| `autor` | `VARCHAR(30)` | `NOT NULL` |
| `editora` | `VARCHAR(50)` | opcional |

## Arquivos

| Arquivo | Operação | Função |
|---|---|---|
| `config.php` | - | Credenciais e nome do banco |
| `teste.php` | - | Testa a conexão com o servidor MySQL |
| `criarbanco.php` | DDL | `CREATE DATABASE IF NOT EXISTS livraria` |
| `criartabela.php` | DDL | `CREATE TABLE livro` |
| `create.php` | Create | `INSERT` de 8 livros pré-definidos |
| `read.php` | Read | `SELECT` dos livros, exibidos em tabela HTML |
| `update.php` | Update | `UPDATE` do autor de *Morte e Vida Severina* para João Cabral de Melo Neto |
| `delete.php` | Delete | `DELETE` por id, usando *prepared statement* |

## Limitações conhecidas

- Os dados do `create.php` e do `update.php` são fixos no código, não há formulário.
- Rodar `create.php` mais de uma vez duplica os livros.
- O `delete.php` recebe o id por link (método GET), o ideal seria usar POST.
- Credenciais direto no código, adequado só para ambiente local.

## Próximos passos

- Criar formulários HTML para inserir e editar livros.
- Usar *prepared statements* também no `create.php` e no `update.php` quando houver entrada de dados.
- Trocar o `delete` por POST e evitar inserções duplicadas.

## O que aprendi

- Conectar PHP ao MySQL usando PDO.
- Tratar erros com `try/catch` e `PDOException`.
- Executar comandos SQL (`CREATE`, `INSERT`, `SELECT`, `UPDATE`, `DELETE`) a partir do PHP.
- Usar *prepared statements* para passar parâmetros com segurança.
- Separar a configuração de conexão em um arquivo reutilizável.