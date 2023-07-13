from rest_framework import serializers
from .models import EditorialModel

class EditorialSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = EditorialModel
        fields = ['id','editorial','estado','fecha']

class EditorialUpdateSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = EditorialModel
        fields = ['id','editorial']