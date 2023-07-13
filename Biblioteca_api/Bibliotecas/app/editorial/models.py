from django.db import models

# Create your models here.

class EditorialModel(models.Model):

    id = models.BigIntegerField(db_column='id',primary_key=True)
    editorial = models.CharField(db_column='editorial',max_length=50)
    estado = models.BooleanField(db_column='estado',default=True)
    fecha = models.DateTimeField(db_column='fecha',auto_now_add=True)

    class Meta:
        managed = True
        db_table = 'editorial'
        verbose_name = 'editorial'
        verbose_name_plural = 'editoriales'