Projeto para um sistema de perguntas

------------
### Funcionamento

O sistema está dividido em duas partes:

- A parte do admin pode adicionar perguntas, alimentar o banco a partir de um arquivo .csv, gerar um QRCode e um relatório das respostas.
  -O QRCode é gerado a partir do texto contido na caixa de texto URL.
  -Os usuários inseridos possuem sua senha de login como padrão "123456".
  
- A parte do usuário apenas responde às perguntas que estão dentro da janela de tempo e referentes ao seu curso.

------------
### Banco de Dados

O banco utilizado esta disponível dentro da pasta Banco Modelo, possui uma representação visual e o arquivo sql.
Também está inserido um modelo para o arquivo .csv que é utilizado para preencher o banco.
