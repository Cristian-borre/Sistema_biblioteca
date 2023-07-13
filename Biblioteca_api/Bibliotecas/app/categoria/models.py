from django.db import models

# Create your models here.

class CategoriaModel(models.Model):

    id = models.BigIntegerField(db_column='id', primary_key=True)
    categoria = models.CharField(db_column='categoria', max_length=50)
    estado = models.BooleanField(db_column='estado', default=True)
    fecha = models.DateTimeField(db_column='fecha', auto_now_add=True)

    class Meta:
        managed = True
        db_table = 'categoria'
        verbose_name = 'categoria'
        verbose_name_plural = 'categorias'