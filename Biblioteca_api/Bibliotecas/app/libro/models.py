from django.db import models
from app.autor.models import AutorModel
from app.categoria.models import CategoriaModel
from app.editorial.models import EditorialModel
from app.encuadernado.models import EncuadernadoModel

# Create your models here.

class LibroModel(models.Model):

    id = models.AutoField(primary_key=True)
    titulo = models.CharField(db_column='titulo',max_length=50)
    autor = models.ForeignKey(AutorModel,db_column='autor',on_delete=models.PROTECT)
    categoria = models.ForeignKey(CategoriaModel,db_column='categoria',on_delete=models.PROTECT)
    editorial = models.ForeignKey(EditorialModel,db_column='editorial',on_delete=models.PROTECT)
    encuadernado = models.ForeignKey(EncuadernadoModel,db_column='encuadernado',on_delete=models.PROTECT)
    ejemplares = models.IntegerField(db_column='ejemplares')
    img = models.CharField(db_column='img',max_length=50)
    estado = models.BooleanField(db_column='estado',default=True)
    fecha = models.DateTimeField(db_column='fecha',auto_now_add=True)

    class Meta:
        managed = True
        db_table = 'libro'
        verbose_name = 'libro'
        verbose_name_plural = 'libros'