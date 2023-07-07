DELIMITER //

CREATE PROCEDURE create_table(
    IN table_name VARCHAR(250),
    IN columns_def TEXT
)
BEGIN
    SET @sql = CONCAT('CREATE TABLE IF NOT EXISTS', table_name ,'(',columns_def,')');
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

DELIMITER//