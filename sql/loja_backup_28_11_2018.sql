CREATE DATABASE  IF NOT EXISTS `loja` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `loja`;
-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: loja
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Alimentos'),(2,'Eletrônicos'),(3,'Brinquedos'),(4,'Escolar'),(5,'Material de construção'),(6,'Bebidas'),(7,'Tecnologia');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_venda`
--

DROP TABLE IF EXISTS `produto_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `produto_venda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) DEFAULT NULL,
  `id_venda` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produto_idx` (`id_produto`),
  KEY `id_venda_idx` (`id_venda`),
  CONSTRAINT `id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `id_venda` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_venda`
--

LOCK TABLES `produto_venda` WRITE;
/*!40000 ALTER TABLE `produto_venda` DISABLE KEYS */;
INSERT INTO `produto_venda` VALUES (18,15,10003,1,2099.90,2099.90),(19,5,10004,2,599.00,1198.00),(20,7,10005,3,389.90,1169.70),(21,11,10006,1,1549.00,1549.00),(22,12,10007,2,823.06,1646.12),(23,9,10008,1,3577.35,3577.35),(24,9,10009,2,3577.35,7154.70),(25,7,10009,2,389.90,779.80),(26,14,10009,5,98.40,492.00);
/*!40000 ALTER TABLE `produto_venda` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `produto_venda_BEFORE_INSERT` BEFORE INSERT ON `produto_venda` FOR EACH ROW BEGIN
	DECLARE finalized BOOLEAN;
    DECLARE valor DECIMAL(10,2);
    DECLARE msg TEXT;
    
    -- Primeira parte do trigger para impedir a inserção de produtos em uma venda finalizada --
    SELECT finalizada INTO finalized
    FROM vendas WHERE id = NEW.id_venda;
    
    IF finalized = TRUE THEN
		SET msg = CONCAT('Esta venda já foi finalizada, impossivel adicionar itens.');
        -- sqlstate '45000' = unhandled user-defined exception
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
	END IF;
    
    -- Segunda parte do trigger para definir o valor total do item_venda -- 
    SELECT p.preco INTO valor FROM produtos p WHERE p.id = NEW.id_produto;
    
    SET NEW.valor_unitario = valor;
    SET NEW.valor_total = NEW.valor_unitario * NEW.quantidade;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `produto_venda_AFTER_INSERT` AFTER INSERT ON `produto_venda` FOR EACH ROW BEGIN
	UPDATE vendas v SET v.valor_total = v.valor_total + NEW.valor_total WHERE v.id = NEW.id_venda;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `produto_venda_BEFORE_UPDATE` BEFORE UPDATE ON `produto_venda` FOR EACH ROW BEGIN
	SET NEW.valor_total = NEW.valor_unitario * NEW.quantidade;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `produto_venda_AFTER_UPDATE` AFTER UPDATE ON `produto_venda` FOR EACH ROW BEGIN
	UPDATE vendas v SET v.valor_total = v.valor_total - OLD.valor_total + NEW.valor_total WHERE v.id = OLD.id_venda;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `produto_venda_BEFORE_DELETE` BEFORE DELETE ON `produto_venda` FOR EACH ROW BEGIN
	UPDATE vendas v SET v.valor_total = v.valor_total - OLD.valor_total WHERE v.id = OLD.id_venda;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `descricao` text,
  `id_categoria` int(11) DEFAULT NULL,
  `usado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria_idx` (`id_categoria`),
  CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (5,'Dji Tello - Standard - Alpine',599.00,'* Sinta a diversão\r\nNós nos propusemos a construir o drone mais divertido de todos os tempos, e criamos Tello: um pequeno drone impressionante para crianças e adultos que é muito divertido de voar e ajuda os usuários a aprender sobre drones . Arranje um Tello para descobrir o quão incrível voar pode ser!\r\n* Veja o mundo do céu\r\nQuer esteja num parque, no escritório ou a passear em casa, pode sempre descolar e experimentar o mundo a partir de novas perspectivas interessantes. A Tello possui duas antenas que tornam a transmissão de vídeo extremamente estável e uma bateria de alta capacidade que oferece tempos de voo impressionantemente longo.\r\n* Recursos fantásticos para diversão sem fim\r\nGraças a toda a tecnologia que Tello com um controlador de vôo movido por DJI, você pode executar truques incríveis e com apenas um toque na tela. Voar nunca foi tão divertido e fácil!\r\n* Jogue e vá\r\nComece voando simplesmente jogando Tello no ar.\r\n- 8D Flips\r\nDeslize na tela para realizar acrobacias aéreas.\r\n- Modo de rejeição\r\nTello voa para cima e para baixo da sua mão automaticamente\r\n \r\n* Capture ótimas fotos e vídeos\r\nEquipado com um processador de imagem de alta qualidade, Tello tira fotos e filma vídeos incríveis. Mesmo que você não saiba voar, é possível gravar vídeos em nível profissional com o EZ Shots e compartilhá-los nas mídias sociais em seu smartphone.\r\n- Tiros EZ\r\n \r\n* Grave vídeos curtos coordenados com Circle, 360 e Up & Away.\r\n \r\n- Estabilização Eletrônica de Imagem\r\nCapture imagens claras de forma consistente.\r\n \r\n- Processador Intel\r\nO processador profissional produz imagens de alta qualidade.\r\n \r\n- 5 MP Fotos\r\nPreserve ótimas memórias com imagens de alta resolução\r\n \r\nItens Inclusos:\r\n01 - Drone \r\n04 - Par de Hélices\r\n01 - Kit de Protetor de Hélices\r\n01 - Bateria\r\n01 - Removedor de Hélices',7,0),(6,'Drone DJI Tello Branco',549.00,'Construíram o drone mais divertido de todos os tempos. Nós apresentamos o Tello: um minidrone fascinante para crianças e adultos, que é um fenômeno do voo e ajuda os usuários a aprender sobre drones usando comandos de codificação',7,0),(7,'Mini Drone Cheerson Cx10w Com Camera Hd Fpv Wifi',389.90,'Transmite imagens FPV para seu celular Android ou Iphone!\r\n\r\nControlado com celular Android ou Iphone! Não acompanha rádio controle. \r\nEste Micro Multirotor apesar de pequeno não é um Brinquedo, não voa sozinho, exige prática para pilotá-lo, se você é iniciante e nunca pilotou um modelo desse, há grandes chances de você o danificar na primeira tentativa de decolagem caso não siga todos os passos necessários para pilotagem.\r\n\r\n\r\nCada bateria carregada tem autonomia de 5 a 6 minutos, dependendo do estilo de vôo e ambiente. Este é o tempo normal para qualquer Helicóptero Elétrico.\r\n\r\nCâmera de 0.3mp de boa resolução\r\n',7,0),(8,'CANON EOS REBEL T6i KIT 18-55mm STM - 24MP',2927.50,'A Canon EOS T6i traz mais facilidade ao capturar momentos especiais e gravar vídeos de maneira muito fácil. Seu sensor CMOS (APS-C) de 24.2 Megapixels de resolução proporciona fotos bem detalhadas, limpas e com aspecto natural. Você pode fazer vídeos Full',7,0),(9,'Canon EOS T6i, WIFI com 18-55mm f/3.5-5.6 IS STM + cartão SanDisk 32GB + Bolsa',3577.35,'A EOS Rebel T6i conta com sensor de 24,2 megapixels CMOS APS-C e o DIGIC 6 Processador de Imagem, ambos trabalham juntos para produzir imagens de alta resolução em uma variedade de condições de disparo. Isto é possível através de uma sensibilidade do ISO 100-12,800, que é expansível para 25.600.Produzir vídeos HD são fáceis com AF avançado da EOS Rebel T6i que fornece foco preciso e veloz em assuntos. Avançado sistema de Análise da Cena EOS da Canon ajusta automaticamente as configurações da câmera para produzir os melhores resultados  em fotografias de amigos, paisagens, cenas de esportes e em situações onde a existência de luz é pouca.Captura de vídeo em Full HD 1080p que suporta Servo Filme para rastreamento de foco contínuo de objetos em movimento durante a gravação. Controle de exposição manual e um built-in microfone estéreo com ajuste manual do nível de áudio fornecem controle de alta qualidade sobre o seu disparo, e múltiplas taxas de quadro e resoluções a fim de fornecer opções de nível de qualidade e de disparo estilística.Stills podem ser capturados durante a gravação de vídeo, simplesmente pressionando o botão do obturador da câmera.Para focagem rápida e precisa em uma variedade de situações, o T6i apresenta um de 19 pontos todos do tipo cruzado O sistema AF. Isto permite o desempenho de focagem rápida quando se utiliza o visor, bem como nos modos de seleção da área.Monitor LCD Variável de  3.0 \', sua capacidade de inclinação e rotação faz gravar em ângulos fácilmente, e um revestimento resistente a manchas mantém o monitor claro. Controle touchscreen intuitivo torna o controle de menu simples, e oferece Toque focagem automática.A primeira da linha EOS Rebel a contar com Wi-Fi e NFC embutidos, agora a conectividade sem fio fornece uma maneira perfeita para trocar imagens e vídeos com dispositivos compatíveis. É mais fácil e mais conveniente do que nunca para compartilhar filmes e fotos, não importa o local.Near Field Communication * (NFC) permite a fácil emparelhamento com dispositivos Android e iOS.Com um desempenho rápido em uma série de ambientes de gravação, a EOS Rebel T6i faz o trabalho duro, permitindo que você se concentrar em fazer fotos deslumbrantes e filmes em HD.',7,0),(10,'Smart TV LED 32\" Samsung 32J4300 com Conversor Digital 2 HDMI 1 USB Wi-Fi Integrado',999.00,'A Smart TV Samsung UN32J4300 possui tela LED de 32” e definição HD 720p, oferecendo imagens de qualidade para uma experiência visual realista. Além de funcionar como uma TV convencional, este modelo conta com Wi-Fi embutido para facilitar o acesso a conteúdos da internet e a aplicativos como Netflix e Youtube, o que é um diferencial para usuários que desejam personalizar a programação.',7,0),(11,'Smart TV LED 43\" Samsung 43J5200 Full HD com Conversor Digital 2 HDMI 1 USB Wi-fi integrado',1549.00,'A Smart TV Samsung LED J5200 oferece todas as facilidades de uma TV inteligente com acesso a conteúdos on demand como Netflix e Youtube e uma infinidade de aplicativos de maneira intuitiva e prática por meio do Wireless LAN Built-In. Além disso, conta com resolução Full HD 1080p, para imagens muito mais reais e nítidas e um design fino com espessura fina para conferir elegância a qualquer ambiente.\r\n\r\n\r\nScreen Mirroring\r\nIdeal para conectar dispositivos móveis à TV, esta tecnologia permite espelhar toda a tela de smartphones e tablets para o usuário aproveitar em tela grande toda a sorte de aplicativos e jogos de seus dispositivos.\r\n\r\n\r\nRecursos de Imagem\r\nEste modelo traz ainda o recurso Wide Color Enhancer que ajuda a intensificar a tonalidade das cores, tornando a experiência mais real e o Clear Motion Rate para imagens em movimento com maior fidelidade.\r\n\r\n\r\nConnect Share Movie\r\nPor meio de uma conexão USB, é possível conectar um pen drive ou HD externo diretamente na TV e reproduzir filmes, músicas ou fotos. Uma ótima maneira de ver as imagens das viagens de férias, ou ainda ouvir playlists com tranquilidade.\r\n\r\n\r\nOutros Recursos\r\nCom receptor de sinal digital, esta TV não necessita de nenhum outro dispositivo para capturar as imagens da melhor maneira. Oferece ainda duas entradas HDMI para a conexão de dispositivos de alta definição como Blu-Ray Players e Home Theaters.',7,0),(12,'Caixa de Som Bluetooth JBL Xtreme Preto 40W',823.06,'Som extremamente poderoso com seus 4 transdutores ativos e 2 radiadores passivos. Laterais emborrachadas, o Xtreme é resistente à respingos d´água e proporciona até 15 horas de automonia de som com alta qualidade.\r\n\r\nJBL Xtreme é a mais nova caixa de som Bluetooth portátil que oferece um som extremamente poderoso com seus quatro transdutores ativos e dois radiadores passivos. O JBL Xtreme vem com 1 termo de garatia e alças que facilitam o transporte do equipamento. Esta caixa de som proporciona 15 horas de som contínuo de alta qualidade de áudio estéreo.\r\n\r\nAlém disso, apresenta duas entradas USB para recarregar seus dispositivos móveis e materiais de alta qualidade com laterais emborrachadas que fazem com que ele seja a prova de respingos dágua.\r\n\r\nO JBL XTREME também possui cancelamento de ruído para chamadas que proporcionam um som limpo e cristalino e conta com a mais nova tecnologia JBL CONNECT que permite conectar até dois dispositivos com a mesma tecnologia ou até três usuários diferentes que utilizem seus smartphones ou tablets na mesma caixa Bluetooth, de forma alternada. Compre JBL Xtreme e compartilhe a melhor experiência sonora com seus amigos.\r\n\r\nTransmissão sem fio Bluetooth \r\nTransmita, sem fio, som stéreo de alta qualidade a partir do seu smartphone ou tablet. \r\n\r\nBateria Recarregável de 10.000mAH\r\nBateria embutida recarregável de Lítio suporta até 15 horas de execução e carrega dispositivos através da porta USB. \r\n\r\nViva-Voz\r\nAtenda ligações pelo viva-voz através de um toque de botão - som cristalino graças ao sistema de cancelamento de eco e ruído.\r\n\r\nÀ prova de respingos \r\nSer à prova de respingos significa não ter mais de se preocupar com chuva ou gotas d\'água. Você pode mesmo limpar a caixa sob a torneira, apenas não mergulhe o equipamento. \r\n\r\nJBL CONNECT \r\nMonte seu próprio ecossistema ligando em conjunto múltiplas caixas com JBL Connect para aumentar a experiência da audição. \r\n\r\nMaterial Lifestyle \r\nO Xtreme foi feito com material de tecido resistente e laterais emborrachadas que permitem maior durabilidade do produto para acompanhar todos seus momentos. \r\n\r\nJBL Radiadores passivos \r\nApresenta dois radiadores passivos nas laterais para demonstrar o quanto essa caixa é poderosa. Sinta os graves impactantes. ',7,0),(13,'Caixa de Som Portátil JBL Flip4 16W Com Bluetooth à Prova D’água Preto',369.00,'Sua paixão é a música? A paixão da JBL é satisfazer a sua com a mais nova geração do premiado FLIP. A caixa de som Bluetooh FLIP 4 fornece uma grande experiência em todos os sentidos. Com 12 horas* contínuas de som estéreo de alta qualidade e potência de saída de 2 x 8W, é à prova d’água. Compacta e portátil, a FLIP 4 conta, ainda, com alça lateral para transporte e faz pareamento com mais de 100 caixas compatíveis.',7,0),(14,'Caixa de som Jbl Go / Bluetooth / Micro USB / Conexão Auxiliar / Preto',98.40,'A JBL GO 2 é uma caixa de som com Bluetooth à prova dágua completa para levar com você para toda parte. Transmita música sem fio através de Bluetooth por até 5 horas ininterruptas de som com qualidade JBL. Fazendo barulho com seu novo design IPX7 à prova dágua, a GO 2 dá aos amantes da música a oportunidade de levar a caixa de som para a beira da piscina ou da praia. A GO 2 também oferece experiência de chamada telefônica com som nítido e claro com seu viva-voz incorporado com cancelamento de ruídos. Elaborado em design compacto com 12 cores atraentes à sua escolha, a GO 2 eleva seu estilo a um nível totalmente inédito.',7,0),(15,'Notebook Acer ES1-572-347R Intel Core i3 4GB RAM 500GB HD 15.6 Windows 10',2099.90,'Sistema Operacional\r\nWindows 10\r\n\r\n...................................\r\nProcessador\r\nIntel® Core™ i3-6006U\r\n\r\n...................................\r\nMemória\r\n4 GB DDR4\r\n\r\n...................................\r\nArmazenamento\r\n500 GB HD (5400 RPM)\r\n\r\n...................................\r\nUSB 3.0\r\n1 entrada',7,0);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `senha` char(32) DEFAULT NULL,
  `eh_admin` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'douglas@douglas.com','e10adc3949ba59abbe56e057f20f883e',1),(2,'cliente@cliente.com','202cb962ac59075b964b07152d234b70',0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `finalizada` tinyint(4) DEFAULT '0',
  `id_usuario` int(11) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `id_usuario_idx` (`id_usuario`),
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10010 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (10003,1,2,2099.90),(10004,1,2,1198.00),(10005,1,2,1169.70),(10006,1,2,1549.00),(10007,1,2,1646.12),(10008,1,2,3577.35),(10009,1,2,8426.50);
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'loja'
--

--
-- Dumping routines for database 'loja'
--
/*!50003 DROP PROCEDURE IF EXISTS `new_procedure` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `new_procedure`(IN id_v INT)
BEGIN
	DECLARE maislinhas INT DEFAULT 0;
    DECLARE id_prod INT;
    DECLARE nome_prod VARCHAR(255);
    DECLARE quant INT;
    DECLARE v_unitario DECIMAL(10,2);
    DECLARE v_total DECIMAL(10,2);
    
    
    DECLARE cur CURSOR FOR SELECT pv.id_produto, pv.quantidade, pv.valor_unitario, pv.valor_total
							FROM produto_venda pv
							WHERE pv.id_venda = id_v;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET maislinhas=1;
    
    DROP TEMPORARY TABLE IF EXISTS tbl_result;
    CREATE TEMPORARY TABLE tbl_result(
		produto VARCHAR(255),
        quantidade INT,
        valor_unitario NUMERIC(10,2),
        valor_total NUMERIC(10,2)
	);
    
    OPEN cur;
    
    loop_calc: LOOP FETCH cur INTO id_prod, quant, v_unitario, v_total;
		IF maislinhas=1 THEN
			LEAVE loop_calc;
		END IF;
        
		SELECT p.nome INTO nome_prod FROM produtos p WHERE id = id_prod;
        INSERT INTO tbl_result VALUES (nome_prod, quant, v_unitario, v_total);
	END LOOP loop_calc;
    
    SELECT * FROM tbl_result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-28 16:44:22
