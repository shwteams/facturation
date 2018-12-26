@echo WELCOME to DO BACKUP TOOL db_facturation
mysqldump -u root -h localhost -p db_facturation --routines > backup_db_facturation.sql
@PAUSE