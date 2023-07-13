from django.shortcuts import render
from rest_framework import viewsets
from .serializer import CategoriaSerializer, CategoriaUpdateSerializer
from .models import CategoriaModel
from rest_framework.permissions import IsAuthenticated
from rest_framework.response import Response
from rest_framework.decorators import action

# Create your views here.

class CategoriaViewSet(viewsets.ReadOnlyModelViewSet):

    queryset = CategoriaModel.objects.all()        
    serializer_class = CategoriaSerializer
    model = CategoriaModel
    permission_classes = [IsAuthenticated]

    def list(self,request):
        try:
            categoria = list(CategoriaModel.objects.filter().values())
            if len(categoria) > 0:
                message = {'message':'Categorias listadas','data':categoria}
            else:
                message = {'message':'Categorias no listadas'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    def post(self,request):
        try:
            serializer = CategoriaSerializer(data=request.data,context={'request':request})
            if serializer.is_valid():
                serializer.save()
                message = {'message':'Categoria creada','data':serializer.data}
            else:
                message = {'message':'Categoria no creada'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
    
    def put(self,request,**kwargs):
        try:
            categoria = CategoriaModel.objects.filter(id=kwargs['pk']).first()
            if categoria:
                serializer = CategoriaUpdateSerializer(categoria,data=request.data,context={'request':request},partial=False)
                if serializer.is_valid():
                    serializer.save()
                    message = {'message':'Categoria actualizada','data':serializer.data}
                else:
                    message = {'message':'Categoria actualizada'}
            else:
                message = {'message':'Categoria no encontrada'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
    
    @action(detail=False,methods=['delete'] , url_path='categoria/(?P<pk>[0-9]+)/')
    def delete(self, request, **kwargs):
        try:
            categoria = list(CategoriaModel.objects.filter(id=kwargs['pk']).values())
            if len(categoria) > 0:
                categoria = CategoriaModel.objects.get(id=kwargs['pk'])
                if categoria.estado == False:
                    categoria.estado = True
                    categoria.save()
                    datos = {'message':'Categoria restaurado'}
                elif categoria.estado == True:
                    categoria.estado = False
                    categoria.save()
                    datos = {'message':'Categoria eliminado'}
            else:
                datos = {'message':'Categoria no encontrado'}
            return Response(datos)
        except Exception as ex:
            responseData = 'excep ' +str(ex)
            return Response(responseData)