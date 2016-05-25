SELECT f.nombre as facultad, c.nombre as carrera, MONTH(r.fecha_registro) as mes, COUNT(DISTINCT t.titulo) as cantidad
FROM facultad f
JOIN carrera c ON c.facultad_id = f.id
JOIN tesis t ON t.carrera_id = c.id
JOIN registro r ON r.tesis_id = t.id
WHERE YEAR(r.fecha_registro) = '2014'
GROUP BY c.nombre, MONTH(r.fecha_registro)
ORDER BY f.nombre ASC, c.nombre ASC, mes ASC

SELECT f.nombre as facultad, COUNT(DISTINCT t.titulo) as cantidad
FROM facultad f
JOIN carrera c ON c.facultad_id = f.id
JOIN tesis t ON t.carrera_id = c.id
JOIN registro r ON r.tesis_id = t.id
WHERE YEAR(r.fecha_registro) = '2014'
GROUP BY f.nombre
ORDER BY f.nombre ASC, c.nombre ASC

SELECT id, titulo
FROM tesis
GROUP BY titulo
HAVING COUNT(*)>1

SELECT *
FROM alumno
WHERE tesis_id = '4'

/* PAra el bdtesis */
SELECT titulo, id
FROM registro
WHERE titulo IN (SELECT titulo
    FROM registro
    GROUP BY titulo
    HAVING COUNT(*)>1 )
ORDER BY titulo

SELECT id, titulo
FROM registro
GROUP BY titulo
HAVING COUNT(*)>1

SELECT *
FROM registro
WHERE titulo = 'Bernal Bernal, Rosmery'

/* EDITAR */
2678
2168
1561
1522
1444
1086
1073
1069
1019
976
155

 Vargas Flores; Vargas Flores, David Braulio ; Vargas Flores, David Braulio 

UPDATE registro SET codigo = "1716", autor = 'Vargas Flores, David Braulio' WHERE id = 2678
UPDATE registro SET autor = 'MurguÃ­a Reyes, MoisÃ©s IvÃ¡n' WHERE id = 2168
 