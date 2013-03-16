require 'socket'      # Sockets are in standard library
require "mysql"

host = '192.168.0.102'
port = 1030
mysqlserver = "69.167.178.150"
mysqluser =   "cronomap_crono"
mysqlpasswd =  "s@14d1n"
mysqldb = "cronomap_site"
frame = ""
s = TCPSocket.new host, port
#my = Mysql::new(mysqlserver, mysqluser, mysqlpasswd, mysqldb)
my = Mysql::new("192.168.0.105", "teste", "teste", "cronomap")
while frameRcvd = s.recv(3000)
  #verify all content is in this frame (frame should finish with >)
  if frameRcvd[-1,1] == '>'
    #var frame concats frames receiveds
    frame.concat(frameRcvd)
    frameId = frame.split("#").first
    lines=frame.split("#")

    dataToInsert = Array.new {Array.new}
#TODO: verificar se frame está incompleto.Caso esteja entao buscar proximo frame e ver se está completo (> na ultima posição)!
    case frameId

      when "<00004"
        puts "Frame 0004 found!!!"
        query = "INSERT INTO `cronomap`.`prova_tomada` (`POSICAO`, `NUMERO`, `NOME`, `CATEGORIA`, `TOTALVOLTAS`, `DIFERENCA`, `DIFERENCA2`, `MELHOR`, `VOLTAMELHOR`, `ULTIMA`, `VELOCIDADE`, `ABREVIADO`, `BOX`, `TEMPOBOX`, `ATUAL`) VALUES "
        for i in 1...lines.length
          dataToInsert.push(lines[i].split("|"))
        end
        for i in 0...dataToInsert.length
          query.concat("('#{dataToInsert[i][0]}' , '#{dataToInsert[i][1]}', '#{dataToInsert[i][2]}', '#{dataToInsert[i][3]}', '#{dataToInsert[i][4]}', '#{dataToInsert[i][5]}', '#{dataToInsert[i][6]}', '#{dataToInsert[i][7]}', '#{dataToInsert[i][8]}', '#{dataToInsert[i][9]}', '#{dataToInsert[i][10]}', '#{dataToInsert[i][11]}', null, null, 'S')")
          if i != dataToInsert.length - 1 then
            query.concat(",")
          end
        end
        puts query
      when "<00000"
        puts "Found time frame!!!"
        query =  "INSERT INTO `cronomap`.`INFCORRIDA` (`TEMPO`, `CORRIDAPROVA`) VALUES ('#{frame.split("#").last}', 'C');"

    end
    res = my.query(query)

    #var frame should be cleared whe the profess finishes
    frame = ""
  else
    frame.concat(frameRcvd)
    puts "frame nao veio completo!!!"
  end

end
s.close