from django.shortcuts import render
from rest_framework import viewsets
from .models import LibroModel
from .serializer import LibroSerializer, LibroUpdateSerializer
from rest_framework.permissions import IsAuthenticated
from rest_framework.response import Response
from rest_framework.decorators import action

# Create your views here.
class LibroEmpleadoViewSet(viewsets.ReadOnlyModelViewSet):
    
    queryset = LibroModel.objects.all()
    model = LibroModel
    serializer_class = LibroSerializer
    permission_classes = [IsAuthenticated]

    def list(self,request):
        try:
            queryset = list(LibroModel.objects.filter(estado=True))
            if len(queryset) > 0:
                serializer = LibroSerializer(queryset, many=True)
                if serializer:
                    message = {'message':'Libros listados','data':serializer.data}
                else:
                    message = {'message':'error serializer'}
            else:    
                message = {'message':'Libros no listados'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)

class LibroViewSet(viewsets.ReadOnlyModelViewSet):

    queryset = LibroModel.objects.all()
    model = LibroModel
    serializer_class = LibroSerializer
    permission_classes = [IsAuthenticated]

    def list(self,request):
        try:
            queryset = LibroModel.objects.all()
            serializer = LibroSerializer(queryset, many=True)
            if serializer:
                message = {'message':'Libros listados','data':serializer.data}
            else:
                message = {'message':'Libros no listados'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    def post(self,request):
        try:
            serializer = LibroSerializer(data=request.data,context={'request':request})
            if serializer.is_valid():
                model = LibroModel()
                model.titulo = request.data['titulo']
                model.autor_id = request.data['autor_id']
                model.categoria_id = request.data['categoria_id']
                model.editorial_id = request.data['editorial_id']
                model.encuadernado_id = request.data['encuadernado_id']
                model.ejemplares = request.data['ejemplares']
                model.img = request.data['img']
                model.save()

                message = {'message':'Libro creado','data':serializer.data}
            else:
                message = {'message':'Libro no creado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    def put(self,request,**kwargs):
        try:
            libro = LibroModel.objects.filter(id=kwargs['pk']).first()
            if libro:
                serializer = LibroUpdateSerializer(libro,data=request.data,context={'request':request},partial=False)
                if serializer.is_valid():
                    sub = serializer.save()
                    sub.autor_id = request.data['autor_id']
                    sub.categoria_id = request.data['categoria_id']
                    sub.editorial_id = request.data['editorial_id']
                    sub.encuadernado_id = request.data['encuadernado_id']
                    sub.save()
                    message = {'message':'Libro actualizado','data':serializer.data}
                else:
                    message = {'message':'Libro no actualizado'}
            else:
                message = {'message':'Libro no encontrado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    @action(detail=False,methods=['delete'],url_path='libro/(?P<pk>[0-9]+)/')
    def delete(self,request,**kwargs):
        try:
            libro = list(LibroModel.objects.filter(id=kwargs['pk']).values())
            if len(libro) > 0:
                libro = LibroModel.objects.get(id=kwargs['pk'])
                if libro.estado == False:
                    libro.estado = True
                    libro.save()
                    message = {'message':'Libro restaurado'}
                elif libro.estado == True:
                    libro.estado = False
                    libro.save()
                    message = {'message':'Libro eliminado'}
            else:
                message = {'message':'Libro no encontrado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)