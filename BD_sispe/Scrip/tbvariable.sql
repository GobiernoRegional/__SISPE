--INSERTAR
CREATE OR REPLACE FUNCTION fn_variableinsertar(
    nombre character varying,
    sector character,
    justificacion character varying,
    unidadanalisis character varying,
    resposablegestion character varying,
    responsablereporte character varying)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbvariable;			

		IF Cantidad = 0 then
		Codigo = 'VAR001';

		ELSE
		select max(var_codigo) into Codigo from tbvariable;

		Codigo = 'VAR' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbvariable(var_codigo,var_nombre,var_tse_codigo,var_justificacion,var_unidadanalisis,var_resposablegestion,var_responsablereporte)
		values(Codigo,nombre,sector,justificacion,unidadanalisis,resposablegestion,responsablereporte);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_variablemodificar(
    codigo character,
    nombre character varying,
    sector character,
    justificacion character varying,
    unidadanalisis character varying,
    resposablegestion character varying,
    responsablereporte character varying)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbvariable
		set 
			var_nombre   		= nombre,
			var_tse_codigo 		= sector,
			var_justificacion 	= justificacion,
			var_unidadanalisis	= unidadanalisis,
			var_resposablegestion 	= resposablegestion,
			var_responsablereporte 	= responsablereporte
		where 
			var_codigo  = codigo;
		end;
  $BODY$
  LANGUAGE plpgsql;

  
--select fn_variableinsertar('ABCDA',null,'ABCDA','NUMERO','XYS','AXC');
--select fn_variablemodificar('VAR001','ABCDA',null,'ABCDA','NUMEROJJA','XYS','AXC');
--select * from tbvariable

--delete from tbvariable where var_codigo = 'VAR002'