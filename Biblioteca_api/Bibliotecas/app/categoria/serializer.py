from rest_framework import serializers
from .models import CategoriaModel

class CategoriaSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = CategoriaModel
        fields = ['id','categoria','estado','fecha']

class CategoriaUpdateSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = CategoriaModel
        fields = ['id','categoria']