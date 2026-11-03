-- Aplicar uma unica vez no banco existente, que ja possui data DATE.
-- Horarios recuperados dos seis registros originais de popular.txt.
USE sistema_atendimentos;

ALTER TABLE atendimentos ADD COLUMN hora TIME NULL AFTER data;

START TRANSACTION;
UPDATE atendimentos SET hora = '09:00:00'
WHERE id = 1 AND professor_id = 1 AND aluno_id = 1 AND data = '2026-11-03';
UPDATE atendimentos SET hora = '14:00:00'
WHERE id = 2 AND professor_id = 1 AND aluno_id = 2 AND data = '2026-11-04';
UPDATE atendimentos SET hora = '15:30:00'
WHERE id = 3 AND professor_id = 2 AND aluno_id = 3 AND data = '2026-11-10';
UPDATE atendimentos SET hora = '10:00:00'
WHERE id = 4 AND professor_id = 1 AND aluno_id = 4 AND data = '2026-10-27';
UPDATE atendimentos SET hora = '13:30:00'
WHERE id = 5 AND professor_id = 2 AND aluno_id = 5 AND data = '2026-10-28';
UPDATE atendimentos SET hora = '14:00:00'
WHERE id = 6 AND professor_id = 2 AND aluno_id = 2 AND data = '2026-10-30';
COMMIT;

-- Executar a etapa final somente depois de preencher todos os horarios.
ALTER TABLE atendimentos MODIFY COLUMN hora TIME NOT NULL;
