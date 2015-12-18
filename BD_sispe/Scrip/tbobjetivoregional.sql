--INSERTAR
CREATE OR REPLACE FUNCTION fn_objetivoregionalinsertar(
    nombre character varying,
    ejecodigo character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbobjetivo_especifico;			

		IF Cantidad = 0 then
		Codigo = 'OES001';

		ELSE
		select max(oes_codigo) into Codigo from tbobjetivo_especifico;

		Codigo = 'OES' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbobjetivo_especifico(oes_codigo,oes_nombre,oes_eje_codigo)
		values(Codigo,nombre,ejecodigo);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_objetivoregionalmodificar(
    oescodigo character,
    nombre character varying,
    ejecodigo character)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbobjetivo_especifico
		set 
			oes_nombre = nombre,
			oes_eje_codigo = ejecodigo
		where 
			oes_codigo  = oescodigo;
		end;
  $BODY$
  LANGUAGE plpgsql;

  --ELIMINAR
CREATE OR REPLACE FUNCTION fn_objetivoregionaleliminar(
    oescodigo character)
  RETURNS void AS
$BODY$
	declare				
	begin
		delete from tbobjetivo_especifico
		where oes_codigo = oescodigo;
	end;
  $BODY$
  LANGUAGE plpgsql;
  
--select fn_objetivoregionalinsertar('rteer','EJE001');
--select fn_objetivoregionalmodificar('OES001','rteerASA','EJE001');
--select fn_objetivoregionaleliminar('OES001');
--select * from tbobjetivo_especifico