from rest_framework import serializers
from .models import AutorModel

class AutorSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = AutorModel
        fields = ['id','autor','estado','fecha']

class AutorUpdateSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = AutorModel
        fields = ['id','autor']