from django.db import models

# Create your models here.

class AutorModel(models.Model):

    id = models.BigIntegerField(db_column='id', primary_key=True)
    autor = models.CharField(db_column='autor', max_length=50)
    estado = models.BooleanField(db_column='estado', default=True)
    fecha = models.DateTimeField(db_column='fecha', auto_now_add=True)
    
    class Meta:
        managed = True
        db_table = 'autor'
        verbose_name = 'autor'
        verbose_name_plural = 'autores'