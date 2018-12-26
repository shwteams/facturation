@color 2
@echo WELCOME to BACKUP TOOL db_facturation
@echo **********************************************

mysql -h localhost -u root -p db_facturation < backup_db_facturation.sql

@pause