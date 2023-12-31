from django.shortcuts import render
from rest_framework import viewsets
from rest_framework.response import Response
from .serializer import PrestamoSerializer,PrestamoUpdateSerializer
from .models import PrestamoModel
from app.libro.models import LibroModel
from rest_framework.permissions import IsAuthenticated
from django.db.models import Count
from django.db.models.functions import ExtractDay, ExtractMonth

# Create your views here.
class PrestamoCountLibroViewSet(viewsets.ReadOnlyModelViewSet):
    
    queryset = PrestamoModel.objects.all()
    serializer_class = PrestamoSerializer
    model = PrestamoModel
    permission_classes = [IsAuthenticated]

    def list(self,request, *args, **kwargs):
        try:
            resultados = []
            resultados = []
            resultado = PrestamoModel.objects.values('libro').annotate(total_prestamos=Count('libro')).order_by('-total_prestamos')[:5]

            for prestamo in resultado:
                libro_id = prestamo['libro']
                libro = LibroModel.objects.get(id=libro_id)
                resultados.append({
                    'libro': libro.titulo,
                    'total_prestamos': prestamo['total_prestamos']
                })

            message = {'message': 'Prestamos contados', 'data': resultados}
            return Response(message)    
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)

class PrestamoCountReportViewSet(viewsets.ReadOnlyModelViewSet):
    
    queryset = PrestamoModel.objects.all()
    serializer_class = PrestamoSerializer
    model = PrestamoModel
    permission_classes = [IsAuthenticated]

    def list(self,request, *args, **kwargs):
        try:
            libros_prestados = PrestamoModel.objects.annotate(
                mes= ExtractMonth('fecha_prestamo'),dia=ExtractDay('fecha_prestamo')).values('mes','dia').annotate(total_prestamos=Count('*')).order_by('mes','dia')
            data = []
            for libro in libros_prestados:
                data.append({
                    'mes': libro['mes'],
                    'dia': libro['dia'],
                    'total_prestamos': libro['total_prestamos']
                })
            message = {'message': 'Prestamos contados', 'data': data}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)

class PrestamoCountViewSet(viewsets.ReadOnlyModelViewSet):
    
    queryset = PrestamoModel.objects.all()
    serializer_class = PrestamoSerializer
    model = PrestamoModel
    permission_classes = [IsAuthenticated]

    def list(self,request, *args, **kwargs):
        try:
            cant = self.queryset.count()
            message = {'message':'Prestamos contados', 'data':cant}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)

class PrestamoViewSet(viewsets.ReadOnlyModelViewSet):

    queryset = PrestamoModel.objects.all()
    serializer_class = PrestamoSerializer
    model = PrestamoModel
    permission_classes = [IsAuthenticated]

    def list(self,request):
        try:
            queryset = list(PrestamoModel.objects.filter())
            serializer = PrestamoSerializer(queryset, many=True)
            if len(queryset) > 0:
                if serializer:
                    message = {'message':'Prestamos listados','data':serializer.data}
                else:
                    message = {'message':'error serializer'}
            else:
                message = {'message':'Prestamos no listados'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    def post(self,request):
        try:
            serializer = PrestamoSerializer(data=request.data,context={'request':request})
            if serializer.is_valid():
                model = PrestamoModel()
                model.libro_id = request.data['libro_id']
                model.persona_id = request.data['persona_id']
                model.fecha_prestamo = request.data['fecha_prestamo']
                model.estado_prestamo = request.data['estado_prestamo']
                model.save()

                message = {'message':'Prestamo creado','data':serializer.data}
            else:
                message = {'message':'Prestamo no creado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    def put(self,request,**kwargs):
        try:
            prestamo = PrestamoModel.objects.filter(id=kwargs['pk']).first()
            if prestamo:
                serializer = PrestamoUpdateSerializer(prestamo,data=request.data,context={'request':request},partial=False)
                if serializer.is_valid():
                    sub = serializer.save()
                    sub.libro_id = request.data['libro_id']
                    sub.persona_id = request.data['persona_id']
                    sub.fecha_prestamo = request.data['fecha_prestamo']
                    sub.estado_prestamo = request.data['estado_prestamo']
                    sub.save()
                    message = {'message':'Prestamo actualizado','data':serializer.data}
                else:
                    message = {'message':'Prestamo no actualizado'}
            else:
                message = {'message':'Prestamo no encontrado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep ' + str(ex)
            return Response(responseData)
        
    def patch(self,request,**kwargs):
        try:
            prestamo = list(PrestamoModel.objects.filter(id=kwargs['pk']).values())
            if len(prestamo) > 0:
                prestamo = PrestamoModel.objects.get(id=kwargs['pk'])
                if prestamo.estado_prestamo == 2:
                    prestamo.estado_prestamo = 1
                    prestamo.save()
                    message = {'message':'Libro entregado'}
                elif prestamo.estado_prestamo == 3:
                    prestamo.estado_prestamo = 2
                    prestamo.save()
                    message = {'message':'Libro pendiente'}
            else:
                message = {'message':'Libro no encontrado'}
            return Response(message)
        except Exception as ex:
            responseData = 'excep '+ str(ex)
            Response(responseData)