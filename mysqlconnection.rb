#!/bin/env ruby
# encoding: utf-8

require "mysql"




frame = '<00004#1|16|HAN KOD|GT3|26|1:48.902|_|1:56.056|142,8|Marcelo Hahn/Alam Khodair|0|_#2|0|CBU DAR|GT3|26|1:49.057|0.155|1:55.381|142,6|Cacá Bueno/Claudio Dahruj|0|_#3|22|BON JIM|GT3|26|1:49.619|0.717|1:54.978|141,8|Paulo Bonifacio/Sergio Jimenez|0|_#4|1|BRI CON|GT3|26|1:49.621|0.719|1:57.169|141,8|Vadeno Brito/Constatino Jr|0|_#5|105|VFA GUE|GT3|21|1:50.049|1.147|1:54.682|141,3|Vanue Faria/Renan Guerra|0|_#6|3|RDE RIC|GT3|26|1:50.258|1.356|1:54.972|141,0|Rafael Derani/Cláudio Ricci|0|_#7|30|CFA ROS|GT3|26|1:50.803|1.901|1:56.680|140,3|Cleber Faria/Duda Rosa|0|_#8|20|EBR EBR|GT3|26|1:51.297|2.395|2:00.553|139,7|Fabio Ebrahim/Wagner Ebrahim|0|_#9|61|CRO CRO|GT3|25|1:54.606|5.704|1:54.811|135,7|Fernando Croce/Daniel Croce|0|_#10|10|ALM VEN|GTP|24|1:54.918|6.016|1:58.263|135,3|Cristiano Almeida/Pierre Ventu|0|_#11|15|TOZ MAS|GTP|25|1:55.421|6.519|2:06.416|134,7|Felipe Tozzo/Raijan Mascarello|0|_#12|6|PIN BUR|GT4|24|1:55.776|6.874|2:00.736|134,3|Valter Pinheiro/Leo Burti|0|_#13|57|SLA HEL|GT4|24|1:55.791|6.889|2:04.405|134,3|Sérgio Laganá/Alan Hellmeister|0|_#14|46|TOS KRA|GTP|25|1:56.167|7.265|1:57.921|133,8|Carlos Kray/Andersom Toso|0|_#15|4|ROS ROS|GTP|25|1:56.512|7.610|1:58.335|133,4|Felipe Roso/Vinícius Roso|0|_#16|12|COR GEN|GT4|24|1:57.007|8.105|1:59.277|132,9|Leonardo Cordeiro/Vitor Genz|0|_#17|11|STU GON|GT4|24|1:57.715|8.813|2:00.922|132,1|Matheus Stumpf/Patrick Gonçalv|0|_#18|8|OLI FRE|GT4|19|1:57.771|8.869|2:04.536|132,0|Eduardo Oliveira/William Freir|0|_#19|21|GRE ROS|GT4|24|1:58.167|9.265|2:02.748|131,6|Fabio Greco/Valter Rossete|0|_>'

puts frame

frameId = frame.split("#").first
lines=frame.split("#")

dataToInsert = Array.new {Array.new}

if frameId == "<00004" then
  query = "INSERT INTO `cronomap`.`prova_tomada` (`POSICAO`, `NUMERO`, `NOME`, `CATEGORIA`, `TOTALVOLTAS`, `DIFERENCA`, `DIFERENCA2`, `MELHOR`, `VOLTAMELHOR`, `ULTIMA`, `VELOCIDADE`, `ABREVIADO`, `BOX`, `TEMPOBOX`, `CORRIDATOMADA`) VALUES "
  for i in 1...lines.length
    dataToInsert.push(lines[i].split("|"))
  end
  for i in 0...dataToInsert.length
    query.concat("('#{dataToInsert[i][0]}' , '#{dataToInsert[i][1]}', '#{dataToInsert[i][2]}', '#{dataToInsert[i][3]}', '#{dataToInsert[i][4]}', '#{dataToInsert[i][5]}', '#{dataToInsert[i][6]}', '#{dataToInsert[i][7]}', '#{dataToInsert[i][8]}', '#{dataToInsert[i][9]}', '#{dataToInsert[i][10]}', '#{dataToInsert[i][11]}', null, null, 'C')")
    if i != dataToInsert.length - 1 then
      query.concat(",")
    end
  end
end

my = Mysql::new("192.168.0.100", "teste", "teste", "cronomap")




res = my.query(query)


=begin
res.each do |row|
  col1 = row[6]
  col2 = row[7]

  puts col1
  puts col2
end
=end
