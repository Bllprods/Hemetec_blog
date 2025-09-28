-- Criar database (com utf8mb4) e usar
CREATE DATABASE IF NOT EXISTS hemetec
  DEFAULT CHARACTER SET = utf8mb4
  DEFAULT COLLATE = utf8mb4_unicode_ci;
USE hemetec;

-- Forçar InnoDB e remover tabelas antigas (ordem segura)
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS noticia_imagem;
DROP TABLE IF EXISTS noticia_texto;
DROP TABLE IF EXISTS noticia_versao;
DROP TABLE IF EXISTS vr_adm;
DROP TABLE IF EXISTS Noticia;
DROP TABLE IF EXISTS Imagem;
DROP TABLE IF EXISTS Texto;
DROP TABLE IF EXISTS Autor;
DROP TABLE IF EXISTS Formato;
DROP TABLE IF EXISTS ADM;
DROP TABLE IF EXISTS Usuario;
SET FOREIGN_KEY_CHECKS = 1;

-- Tabela ADM (administradores)
CREATE TABLE ADM (
  id_adm INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(200) NOT NULL,
  email VARCHAR(200) NOT NULL UNIQUE,
  senha_hash VARCHAR(255) NOT NULL,
  nivel_acesso TINYINT UNSIGNED NOT NULL, -- 1 = operador, 5 = superadmin etc
  ativo BOOLEAN NOT NULL DEFAULT TRUE,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  INDEX (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Noticia (
  id_noticia INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  -- id_adm INT UNSIGNED NOT NULL,
  id_versionamento INT UNSIGNED NULL,
  data_publicacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  -- slug VARCHAR(255) NULL UNIQUE, -- URL amigável opcional
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  publicado BOOLEAN NOT NULL DEFAULT FALSE,
  visivel BOOLEAN NOT NULL DEFAULT TRUE
  -- FOREIGN KEY (id_adm) REFERENCES ADM(id_adm) ON DELETE CASCADE ON UPDATE CASCADE,
  -- INDEX (id_adm)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela para registrar verificações/ações de admin sobre usuários (vr_adm)
CREATE TABLE vr_adm (
  id_verificacao INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_adm INT UNSIGNED NOT NULL,
  id_noticia INT UNSIGNED NOT NULL,
  acao VARCHAR(100) NOT NULL, -- ex: 'suspender', 'validar', 'editar'
  comentario TEXT NULL,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_adm) REFERENCES ADM(id_adm) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (id_noticia) REFERENCES Noticia(id_noticia) ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX (id_adm)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela Imagem (metadados; armazene arquivos em storage externo quando possível)
CREATE TABLE Imagem (
  id_imagem INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  img_url VARCHAR(1000) NOT NULL, -- permitir URLs longas
  tamanho FLOAT,
  legenda VARCHAR(255),
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  -- INDEX (img_url)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela Texto (conteúdo textual completo; url opcional)
CREATE TABLE Texto (
  id_texto INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  txt_url VARCHAR(1000) NOT NULL,
  titulo VARCHAR(1000) NOT NULL UNIQUE,
  autor VARCHAR(1000),
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  atualizado_em DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  FULLTEXT KEY ft_texto (titulo)
  -- INDEX (titulo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE noticia_versao (
  id_versao INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  -- id_noticia INT UNSIGNED NOT NULL,
  cod_version TINYINT UNSIGNED NOT NULL,
  comentario_edicao VARCHAR(500) NULL,
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  -- FOREIGN KEY (id_noticia) REFERENCES Noticia(id_noticia) ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX (cod_version)
  -- INDEX (id_noticia)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE versionamento (
  id_versionamento INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_noticia INT UNSIGNED NOT NULL,
  id_versao INT UNSIGNED NOT NULL,
  CONSTRAINT id_noticia FOREIGN KEY (id_noticia) REFERENCES Noticia(id_noticia) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT id_versao FOREIGN KEY (id_versao) REFERENCES noticia_versao(id_versao) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE noticia_imagem (
  id_not_img INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_versao  INT UNSIGNED NOT NULL,
  id_imagem INT UNSIGNED NOT NULL,
  FOREIGN KEY (id_versao) REFERENCES noticia_versao(id_versao) ON DELETE CASCADE,
  FOREIGN KEY (id_imagem) REFERENCES Imagem(id_imagem) ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX (id_versao),
  INDEX (id_imagem)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE noticia_texto (
  id_not_text INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_versao  INT UNSIGNED NOT NULL,
  id_texto INT UNSIGNED NOT NULL,
  FOREIGN KEY (id_versao) REFERENCES noticia_versao(id_versao) ON DELETE CASCADE,
  FOREIGN KEY (id_texto) REFERENCES Texto(id_texto) ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX (id_texto),
  INDEX (id_versao)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

 ALTER TABLE Noticia
 ADD CONSTRAINT id_versionamento FOREIGN KEY (id_versionamento) REFERENCES versionamento(id_versionamento) ON DELETE SET NULL ON UPDATE CASCADE;

-- drop database hemetec

select database * from hemetec
