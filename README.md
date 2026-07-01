# Jabulani Event System

## Visão Geral

Aplicação PHP MVC simples para gerenciamento de eventos e inscrições, com autenticação de usuário e administração.

- Login para usuários e administradores
- Cadastro de participantes
- Perfil com edição de telefone
- Administração de eventos (criar, alterar, excluir)
- Inscrição de usuário em eventos
- Remoção de participante de evento
- Exclusão de usuário do sistema pelo administrador
- Exportação de evento para XML e PDF
- Busca de eventos

## Estrutura do Projeto

- `index.php` - roteador front controller
- `config/jabulanidb.sql` - dump e estrutura do banco de dados
- `src/config/Database/config.php` - configuração da conexão PDO
- `src/controller/` - controladores para usuários, eventos, admin e páginas básicas
- `src/model/` - modelos de negócio e acesso a dados
- `src/DAO/` - classes de acesso a dados para tabelas e relacionamentos
- `src/views/` - views e formulários em PHP
- `uploads/` - pasta para arquivos enviados (não utilizada pela feature atual de eventos)

## Rotas Principais

A aplicação usa o prefixo `/app-jabulani`.

- `/app-jabulani/login` - formulário de login
- `/app-jabulani/autenticar` - autentica o usuário
- `/app-jabulani/logout` - encerra a sessão
- `/app-jabulani/cadastro` - formulário de cadastro de usuário
- `/app-jabulani/salvarUsuario` - salva novo usuário
- `/app-jabulani/perfil` - formulário de edição de perfil
- `/app-jabulani/salvarPerfil` - salva alterações do perfil
- `/app-jabulani/principal` - página inicial básica
- `/app-jabulani/listarEventos` - lista de eventos disponíveis
- `/app-jabulani/formInserirEvento` - formulário de criação de evento (admin)
- `/app-jabulani/inserirEvento` - cria novo evento (admin)
- `/app-jabulani/alterarEvento` - formulário de edição de evento (admin)
- `/app-jabulani/atualizarEvento` - atualiza evento (admin)
- `/app-jabulani/excluirEvento` - exclui evento (admin)
- `/app-jabulani/meusEventos` - lista de eventos inscritos do usuário
- `/app-jabulani/inscrever` - inscreve participante em evento
- `/app-jabulani/buscar` - busca eventos por termo
- `/app-jabulani/detalhesEvento` - página de detalhes do evento (admin)
- `/app-jabulani/removerParticipante` - remove inscrição de participante do evento (admin)
- `/app-jabulani/excluirUsuario` - exclui usuário do sistema (admin)
- `/app-jabulani/exportarEventoXml` - exporta dados do evento em XML
- `/app-jabulani/exportarEventoPdf` - exporta dados do evento em PDF

## Autenticação e Sessões

- Usuário autenticado é marcado em `$_SESSION['usuario_id']`
- Administrador autenticado é marcado em `$_SESSION['admin_id']`
- Sessões usam cookies HTTP-only com `SameSite=Lax`

## Banco de Dados

O projeto usa MySQL/MariaDB com o banco de dados `jabulanidb`.

Tabelas principais:

- `usuarios`
  - `idUsuario`
  - `nomeUsuario`
  - `email`
  - `senha` (hash bcrypt)
  - `telefone`
  - `tipoUsuario` (`admin` ou `participante`)
  - `registroCriado`

- `eventos`
  - `id`
  - `titulo`
  - `descricao`
  - `local`
  - `dataEvento`
  - `registroCriado`

- `usuarioseventos`
  - `id`
  - `idUsuario`
  - `idEvento`
  - `registroCriado`

## Componentes Principais

### Controladores

- `UsuarioController`
  - login, logout, cadastro, edição de perfil
  - exclusão de usuário (admin)
  - API de listagem de usuários

- `EventosController`
  - listagem, criação, edição e exclusão de eventos
  - inscrição de usuários
  - busca de eventos
  - detalhes de evento para admin
  - exportação XML/PDF
  - remoção de participante de evento

### Modelos

- `UsuarioModel`
  - consulta e manipulação de usuários

- `EventoModel`
  - consulta e manipulação de eventos
  - obtenção de participantes
  - remoção de participante de evento

### DAOs

- `UsuarioDAO`
  - CRUD de usuários
  - garante existência das colunas `telefone` e `tipoUsuario`

- `EventoDao`
  - CRUD de eventos
  - busca de eventos por termo

- `UsuarioEventoDAO`
  - inscrição de usuário em evento
  - lista de eventos inscritos por usuário
  - lista de participantes por evento
  - remoção de participante do evento

## UI e Funcionalidades

- `src/views/formLogin.php` - formulário de login com link para cadastro
- `src/views/admin/formCadastro.php` - formulário de cadastro de novo participante
- `src/views/formEditarPerfil.php` - edição de perfil com telefone
- `src/views/eventoView.php` - lista de eventos com ações diferentes para admin e participantes
- `src/views/detalhesEventoView.php` - detalhes do evento e painel de participantes para admin

## Funcionalidades Admin

- criar, editar e excluir eventos
- ver detalhes do evento
- remover participante de um evento
- excluir usuário do sistema
- exportar evento em XML e PDF

## Instalação

1. Coloque o projeto em `htdocs` do XAMPP: `c:\xampp\htdocs\app-jabulani`
2. Importe `config/jabulanidb.sql` no MySQL/MariaDB
3. Atualize `src/config/Database/config.php` com as credenciais do banco
4. Acesse `http://localhost/app-jabulani/login`

## Notas

- As rotas são gerenciadas pelo `index.php` usando `switch` simples.
- A exportação PDF é feita via geração manual de conteúdo PDF.
- O projeto usa Bootstrap 5 a partir de CDN.
- O arquivo `.gitignore` ignora os artefatos `zipar-pasta.zip` e `zipar-pasta/`.
