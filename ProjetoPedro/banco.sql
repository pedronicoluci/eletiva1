-- Cria o banco de dados se ele não existir
CREATE DATABASE IF NOT EXISTS `projetophp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projetophp`;

-- 1. Estrutura da tabela `usuarios` (Acesso ao Sistema)
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insere o usuário administrador padrão para o primeiro login
INSERT IGNORE INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Administrador', 'adm@adm', '123');

-- 2. Estrutura da tabela `cargos` (Entidade Independente)
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Estrutura da tabela `membros` (Depende de Cargos - Relacionamento 1:N)
CREATE TABLE IF NOT EXISTS `membros` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `cargo_id` INT NOT NULL,
  FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Estrutura da tabela `atividades` (Entidade Independente)
CREATE TABLE IF NOT EXISTS `atividades` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(150) NOT NULL,
  `data_atividade` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Estrutura da tabela `participacoes` (Tabela Pivô - Relacionamento N:N entre Membros e Atividades)
CREATE TABLE IF NOT EXISTS `participacoes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `atividade_id` INT NOT NULL,
  `membro_id` INT NOT NULL,
  UNIQUE KEY `membro_atividade_unic` (`atividade_id`, `membro_id`),
  FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`membro_id`) REFERENCES `membros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;