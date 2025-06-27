CREATE DATABASE control_asistencias_gym_unam_basico;
use control_asistencias_gym_unam_basico;

SELECT*FROM users;
SELECT*FROM semestre_elegido;
SELECT*FROM semestres;
SELECT*FROM asistencias;
SELECT*FROM estudiantes;
SELECT*FROM movimientos_asistencia;
describe users;

-- ALTER TABLE movimientos_asistencia
-- CHANGE COLUMN `timestamp` `fecha_hora` DATETIME NOT NULL;


INSERT INTO semestre_elegido (semestre_elegido) VALUES ("2025-2");
INSERT INTO estudiantes (codigo_estudiante, dni, nombre, apellido, email, escuela_profesional, ciclo) 
VALUES (2021204073,75864498,"Erik","Ramos Arocutipa","erik@gmail.com","EPISI",8);
INSERT INTO estudiantes (codigo_estudiante, dni, nombre, apellido, email, escuela_profesional, ciclo) 
VALUES (2021204114,70116858,"Mia","Flores Vizcarra","mia@gmail.com","EPISI",8);


