create database hemetec
 default character set utf8
 collate utf8_general_ci;

use hemetec;

CREATE TABLE Usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE ADM (
    id_adm INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    nivel_acesso INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Noticia (
    id_noticia INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    data_publicacao DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    id_autor INT NOT NULL
    -- FOREIGN KEY (id_autor) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Imagem (
    id_imagem INT PRIMARY KEY AUTO_INCREMENT,
    imgurl VARCHAR(255) NOT NULL,
    legenda VARCHAR(255),
    id_noticia INT NOT NULL,
    FOREIGN KEY (id_noticia) REFERENCES Noticia(id_noticia)
);

CREATE TABLE Texto (
    id_texto INT PRIMARY KEY AUTO_INCREMENT,
    conteudo TEXT NOT NULL,
    id_noticia INT NOT NULL,
    FOREIGN KEY (id_noticia) REFERENCES Noticia(id_noticia)
);
