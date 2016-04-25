-- Describe TABLASBD
CREATE VIEW TablasBD as
SELECT name, sql FROM sqlite_master
WHERE type='table' and name not like 'sqlite%'
ORDER BY name