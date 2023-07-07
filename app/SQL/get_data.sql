CREATE PROCEDURE get_data(
    IN table_name VARCHAR(250),
    IN query TEXT
)
BEGIN
    SET @sql = CONCAT('SELECT * FROM ', table_name, ' WHERE ', query);
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END;
