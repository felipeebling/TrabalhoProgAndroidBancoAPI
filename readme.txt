
banco de dados

CREATE DATABASE sistema_atendimentos;


CREATE TABLE professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    matricula VARCHAR(30) NOT NULL UNIQUE,
    email VARCHAR(150)
);

CREATE TABLE atendimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,

    professor_id INT NOT NULL,
    aluno_id INT NOT NULL,

    data_hora DATETIME NOT NULL,
    duracao INT NOT NULL,
    disciplina VARCHAR(100),

    tipo VARCHAR(20) NOT NULL
        CHECK (tipo IN (
            'DUVIDAS', 'TCC', 'PROJETOS', 'PRATICAS'
        )),

    modalidade VARCHAR(15) NOT NULL
        CHECK (modalidade IN (
            'PRESENCIAL', 'ONLINE'
        )),

    local_link VARCHAR(255),
    descricao TEXT NOT NULL,
    observacoes TEXT,

    situacao VARCHAR(25) DEFAULT 'AGENDADO'
        CHECK (situacao IN (
            'SOLICITADO',
            'AGENDADO',
            'REALIZADO',
            'PARCIAL',
            'NAO_COMPARECEU',
            'NAO_REALIZADO',
            'CANCELADO'
        )),

    conteudo_tratado TEXT,
    compareceu BOOLEAN,
    motivo_cancelamento TEXT,

    encaminhamento TEXT,
    prazo_encaminhamento DATE,
    encaminhamento_concluido BOOLEAN DEFAULT FALSE,

    FOREIGN KEY (professor_id)
        REFERENCES professores(id),

    FOREIGN KEY (aluno_id)
        REFERENCES alunos(id)
);
