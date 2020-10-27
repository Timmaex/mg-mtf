-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Okt 2020 um 23:09
-- Server-Version: 10.4.13-MariaDB
-- PHP-Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mtf_site`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mtf_character`
--

CREATE TABLE `mtf_character` (
  `id` int(11) NOT NULL,
  `steamid` text NOT NULL,
  `job` text NOT NULL,
  `rank` text NOT NULL,
  `codename` text NOT NULL,
  `dienstnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `mtf_character`
--

INSERT INTO `mtf_character` (`id`, `steamid`, `job`, `rank`, `codename`, `dienstnummer`) VALUES
(1, 'STEAM_0:0:86232373', 'd5', 'col', 'Ackerman', 474),
(2, 'STEAM_0:1:100929417', 'd5', 'lcol', 'Rho', 563),
(3, 'STEAM_0:1:169464330', 'n7', '1lt', 'Triton', 389),
(4, 'STEAM_0:0:51426971', 'n7', '2lt', 'Linsi', 670),
(5, 'STEAM_0:1:107932848​', 'd5', 'sgm', 'Sladti', 425),
(6, 'STEAM_0:0:178850058', 'n7', '2lt', 'Kiwi', 844),
(7, 'STEAM_0:1:425974519', 'd5', 'cpt', 'Hidden', 767),
(8, 'STEAM_0:0:195342098', 'n7', '1lt', 'Blackout', 924),
(9, 'STEAM_0:1:33980265', 'd5', '2lt', 'Tron', 259);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mtf_dokumente`
--

CREATE TABLE `mtf_dokumente` (
  `id` int(11) NOT NULL,
  `header` text NOT NULL,
  `info` text NOT NULL,
  `short` text NOT NULL,
  `restriction` int(11) NOT NULL,
  `category` text NOT NULL,
  `value` text NOT NULL,
  `typ` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `mtf_dokumente`
--

INSERT INTO `mtf_dokumente` (`id`, `header`, `info`, `short`, `restriction`, `category`, `value`, `typ`) VALUES
(1, 'PVT Grungausbildung', 'Dieses Dokument dient der Ausbildung von Rekruten', 'pvt_a', 6, 'Lösungsdokumente', '<html><head><meta content=\"text/html; charset=UTF-8\" http-equiv=\"content-type\"></head><body><div class=\"c5 c28\"><p class=\"c7\"><span class=\"c33\">Ausbildung zum Private</span></p><p class=\"c7\"><span class=\"c27\">(15.07.2020)</span></p><p class=\"c7 c29\"><span class=\"c27\"></span></p><p class=\"c10\"><span class=\"c4 c32\"></span></p><a id=\"t.540c1de12d237d9fabcddc4439705c28d1a69ad3\"></a><a id=\"t.0\"></a><table class=\"c25\"><tbody><tr class=\"c24\"><td class=\"c22\" colspan=\"1\" rowspan=\"1\"><p class=\"c23\"><span class=\"c21\">Theoretisches Wissen</span></p><p class=\"c15\"><span class=\"c4\"></span></p><ul class=\"c9 lst-kix_ci006f4bru6f-0 start\"><li class=\"c11\"><span class=\"c4\">Organisatorische Links</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-1 start\"><li class=\"c8\"><span class=\"c4\">Trello (kein Muss f&uuml;r den PVT)</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-2 start\"><li class=\"c23 c30 c16\"><span class=\"c19\"><a class=\"c26\" href=\"https://www.google.com/url?q=https://trello.com/b/Yt6MuX8U/mg-mtf-trello&amp;sa=D&amp;ust=1603644865122000&amp;usg=AOvVaw1yTK_D1zcBrmlgv0PPC8IK\">https://trello.com/b/Yt6MuX8U/mg-mtf-trello</a></span><span class=\"c4\">&nbsp;</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-1\"><li class=\"c8\"><span class=\"c4\">Discord (kein Muss f&uuml;r den PVT)</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-2 start\"><li class=\"c23 c16 c30\"><span class=\"c19\"><a class=\"c26\" href=\"https://www.google.com/url?q=https://discord.gg/wk4vDTG&amp;sa=D&amp;ust=1603644865123000&amp;usg=AOvVaw11gsZv7RPtqZ-eYnCrV_YP\">https://discord.gg/wk4vDTG</a></span><span>&nbsp;</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-1\"><li class=\"c8\"><span class=\"c4\">MTF Regeln (f&uuml;r den PVT zum Durchlesen nach der Ausbildung)</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-2 start\"><li class=\"c3\"><span class=\"c19\"><a class=\"c26\" href=\"https://www.google.com/url?q=https://docs.google.com/document/d/1Q8JYXcP9Ps5wtbeTAHLrZl-pnIFRMqMuZpJJE_4mwUw/edit?usp%3Dsharing&amp;sa=D&amp;ust=1603644865123000&amp;usg=AOvVaw0-X54l06y8Rv9wlBAYvmk9\">https://docs.google.com/document/d/1Q8JYXcP9Ps5wtbeTAHLrZl-pnIFRMqMuZpJJE_4mwUw/edit?usp=sharing</a></span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-1\"><li class=\"c12\"><span class=\"c4\">MTF Strafenkatalog (f&uuml;r den PVT zum Durchlesen nach der Ausbildung)</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-2 start\"><li class=\"c3\"><span class=\"c19\"><a class=\"c26\" href=\"https://www.google.com/url?q=https://docs.google.com/document/d/1PKFONpX79hzcVNbvwFn_idMiLgUJU3jlvJxF8Lh7sFY/edit?usp%3Dsharing&amp;sa=D&amp;ust=1603644865124000&amp;usg=AOvVaw2MIHDuTWueXSP1qWi33vJH\">https://docs.google.com/document/d/1PKFONpX79hzcVNbvwFn_idMiLgUJU3jlvJxF8Lh7sFY/edit?usp=sharing</a></span></li></ul><p class=\"c15 c16\"><span class=\"c4\"></span></p><ul class=\"c9 lst-kix_ci006f4bru6f-0\"><li class=\"c11\"><span class=\"c4\">Was ist die SCP Foundation?</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-1 start\"><li class=\"c8\"><span class=\"c4\">Internationale Gruppierung</span></li><li class=\"c8\"><span class=\"c4\">Viele verschiedene Standorte auf der ganzen Welt</span></li><li class=\"c8\"><span class=\"c4\">Sichern von Anomalien </span></li><li class=\"c8\"><span class=\"c4\">Erforschen von SCPs</span></li><li class=\"c8\"><span class=\"c4\">Schutz der Bev&ouml;lkerung</span></li><li class=\"c8\"><span class=\"c4\">Geheimhaltung der SCPs vor der Bev&ouml;lkerung</span></li></ul><p class=\"c15\"><span class=\"c4\"></span></p><ul class=\"c9 lst-kix_ci006f4bru6f-0\"><li class=\"c11\"><span class=\"c4\">Was ist die MTF</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-1 start\"><li class=\"c8\"><span class=\"c4\">Die Mobile Task Force besteht aus vielen verschiedenen Regimentern, welche dem Schutz der Foundation und der Bev&ouml;lkerung verpflichtet sind.</span></li></ul><p class=\"c15 c13\"><span class=\"c4\"></span></p><ul class=\"c9 lst-kix_ci006f4bru6f-0\"><li class=\"c11\"><span class=\"c4\">Was macht die MTF</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-1 start\"><li class=\"c8\"><span class=\"c4\">Sicherheitspersonal der Area 14</span></li><li class=\"c8\"><span class=\"c4\">Zur&uuml;ckschlagen von angreifenden GoIs</span></li><li class=\"c8\"><span class=\"c4\">Recontainen von breachenden SCPs</span></li><li class=\"c8\"><span>Niederschlagen von meuternden D Klassen</span></li></ul><p class=\"c15 c13\"><span class=\"c4\"></span></p><ul class=\"c9 lst-kix_ci006f4bru6f-0\"><li class=\"c11\"><span class=\"c4\">Welche Einheiten gibt es?</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-1 start\"><li class=\"c12\"><span class=\"c5 c17\">E6 (Village Idiots):</span><span class=\"c5\">&nbsp;Grundpfeiler der Exekutiven der Area 14</span></li><li class=\"c12\"><span class=\"c5 c17\">D5 (Front Runners):</span><span class=\"c1\">&nbsp;ist eine Erweiterung zur E6, welche sich darauf spezialisiert hat, feindliche Interessensgruppen, sowie Eindringlinge effektiv und so schnellst wie m&ouml;glich auszuschalten.</span></li><li class=\"c12\"><span class=\"c5 c17\">N7 (Hammer-Down):</span><span class=\"c5\">&nbsp; ist eine Erweiterung zur E6, welche sich darauf spezialisiert hat, mit </span><span class=\"c5\">hochkalibrigen</span><span class=\"c1\">&nbsp;Waffen und dicker Panzerung die Front eines Angriffes zu bilden. Sie halten zwar durch ihren K&ouml;rperbau mehr aus, sind daf&uuml;r aber auch langsamer.</span></li></ul><p class=\"c10\"><span class=\"c1\"></span></p><ul class=\"c9 lst-kix_ci006f4bru6f-0\"><li class=\"c6\"><span class=\"c0\">MTF Ausr&uuml;stung</span></li></ul><ul class=\"c9 lst-kix_ci006f4bru6f-1 start\"><li class=\"c12\"><span class=\"c5\">Taser (Random Taser Regel beachten(Grundregeln der Foundation))</span></li><li class=\"c12\"><span class=\"c1\">Waffenchecker (Linksklick: durchsuchen; Rechtsklick: Abnehmen)</span></li><li class=\"c12\"><span class=\"c1\">Handschellen (Bei unkooperativen Personal)</span></li><li class=\"c12\"><span class=\"c1\">Brechstange (Zur Benutzung bei T&uuml;ren an der Oberfl&auml;che)</span></li></ul><p class=\"c10\"><span class=\"c1\"></span></p><ul class=\"c9 lst-kix_ncmta49fr0iq-0 start\"><li class=\"c6\"><span class=\"c0\">How-To: Funken</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1 start\"><li class=\"c12\"><span class=\"c1\">Richtiges Funken, mit Hilfe von dem &ldquo;Richtig funken&rdquo;-Schild in der Baracke, deutlich dem Rekruten erkl&auml;ren</span></li><li class=\"c12\"><span class=\"c1\">funk: H&ouml;rt jeder in der FD. zB &ldquo;/funk an FD* Status?&rdquo;</span></li><li class=\"c12\"><span class=\"c1\">funkg: H&ouml;rt jeder mit einem Funkger&auml;t</span></li><li class=\"c12\"><span class=\"c1\">funkc: H&ouml;rt jeder im aktuellen Funkchannel</span></li><li class=\"c12\"><span class=\"c5\">Gr&uuml;n: </span><span class=\"c1\">Bereit zum Sprechen</span></li><li class=\"c12\"><span class=\"c1\">Rot: Stummgeschalten</span></li><li class=\"c12\"><span class=\"c1\">10-1: Zum Dienst anmelden</span></li><li class=\"c12\"><span class=\"c1\">10-3: Negativ</span></li><li class=\"c12\"><span class=\"c1\">10-4: Positiv</span></li><li class=\"c12\"><span class=\"c1\">10-12: Vom Dienst abmelden</span></li><li class=\"c12\"><span class=\"c1\">10-20: Standortabfrage</span></li><li class=\"c12\"><span class=\"c1\">Code Red -&gt; in den MTF &amp; CT Funk</span></li></ul><p class=\"c10\"><span class=\"c1\"></span></p><ul class=\"c9 lst-kix_ncmta49fr0iq-0\"><li class=\"c6\"><span class=\"c5 c31\">Foundationrangordnung</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1 start\"><li class=\"c12\"><span class=\"c1\">Dokument schicken; Zum selbst&auml;ndigen Durchlesen nach der Ausbildung</span></li><li class=\"c12\"><span class=\"c1\">Anmerkung f&uuml;r verk&uuml;rzte Rangordnung, unterhalb des Bildes</span></li><li class=\"c12\"><span class=\"c19 c5\"><a class=\"c26\" href=\"https://www.google.com/url?q=https://modern-gaming.net/forum/thread/26292-rangordnung-der-foundation-recontainmethoden/&amp;sa=D&amp;ust=1603644865132000&amp;usg=AOvVaw2zNPGSLOWFypGcrMTtV_Et\">https://modern-gaming.net/forum/thread/26292-rangordnung-der-foundation-recontainmethoden/</a></span></li></ul><p class=\"c10 c13\"><span class=\"c0\"></span></p><p class=\"c10 c13\"><span class=\"c0\"></span></p><p class=\"c10 c13\"><span class=\"c0\"></span></p><ul class=\"c9 lst-kix_ncmta49fr0iq-0\"><li class=\"c6\"><span class=\"c0\">Recontainmethoden aller aktueller SCPs in Area 14</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1 start\"><li class=\"c12\"><span class=\"c5 c17\">035 (Keter): </span><span>Der Wirt von SCP-035 muss vernichtet werden, bevor 035 den K&ouml;rper aufgibt und runterf&auml;llt. Die Maske kann daraufhin zur Zelle getragen werden.</span></li><li class=\"c12\"><span class=\"c5 c17\">049 (Euclid): </span><span>Da SCP-049 bei Ber&uuml;hrung t&ouml;tet, muss das Containment Team Schutzanz&uuml;ge benutzen und SCP-049 in Fesseln legen. Davor werden alle Instanzen von SCP-049-2 vernichtet.</span></li><li class=\"c12\"><span class=\"c5 c17\">066 (Euclid): </span><span>Im beruhigten Zustand l&auml;sst sich SCP-066 einfach in eine Zelle eskortieren. Wenn es sich wehren sollte oder schon im aggressiven Zustand ist, muss abgewartet werden, bis es sich beruhigt. In allen F&auml;llen l&auml;sst es sich an der Leine mitnehmen.</span></li><li class=\"c12\"><span class=\"c5 c17\">096 (Euclid): </span><span>SCP-096 daran zu hindern, seine Zielperson zu t&ouml;ten, ist unm&ouml;glich. Es ist jedoch m&ouml;glich, die Zielperson ausfindig zu machen und zu terminieren, bevor 096 ausbricht. Sollte es bereits ausgebrochen sein, muss abgewartet werden, bis es sich beruhigt hat, woraufhin man sich, ohne Augenkontakt zu machen, dem SCP n&auml;hert und einen Sack &uuml;ber den Kopf st&uuml;lpt. Danach l&auml;sst es sich gefahrlos in die Zelle bringen.</span></li><li class=\"c12\"><span class=\"c5 c17\">173 (Euclid):</span><span class=\"c5\">&nbsp;</span><span>Es sind mindestens zwei Personen n&ouml;tig, um SCP-173 einzufangen. Person A f&auml;ngt die Statue mit dem K&auml;fig ein, w&auml;hrend Person B (oder auch mehrere Leute) dauerhaften Blickkontakt mit 173 halten. Zu keiner Zeit darf die direkte Sicht unterbrochen werden, da die Gefahr besteht, dass 173 ausbrechen k&ouml;nnte.</span><span class=\"c5\">&nbsp;</span></li><li class=\"c12\"><span class=\"c5 c17\">527 (Euclid):</span><span class=\"c1\">&nbsp;Man kann mit ihm wie mit einen normalen Menschen reden und das SCP einfach sagen, dass er zur&uuml;ckgehen soll.</span></li><li class=\"c12\"><span class=\"c5 c17\">966 (Euclid): </span><span class=\"c1\">Ist bei Sichtkontakt au&szlig;erhalb seiner Zelle zu terminieren.</span></li><li class=\"c12\"><span class=\"c5 c17\">131 (Safe, Thaumiel):</span><span class=\"c5\">&nbsp;Kann wie ein Haustier zur&uuml;ck gescheucht werden. Drohungen sollten unterlassen werden, um Angst des SCP zu vermeiden. </span></li><li class=\"c12\"><span class=\"c5 c17\">999 (Safe):</span><span class=\"c5\">&nbsp;Kann man mit S&uuml;&szlig;igkeiten locken.</span></li></ul><p class=\"c10\"><span class=\"c1\"></span></p><ul class=\"c9 lst-kix_ncmta49fr0iq-0\"><li class=\"c6\"><span class=\"c0\">Status Codes in der Area</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1 start\"><li class=\"c12\"><span class=\"c1\">Green: </span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-2 start\"><li class=\"c2\"><span class=\"c1\">Verst&auml;rkte Sicherheitsma&szlig;nahmen nicht ben&ouml;tigt. </span></li><li class=\"c2\"><span class=\"c1\">Personal kann gewohnter Arbeit nachgehen.</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1\"><li class=\"c12\"><span class=\"c5\">Yellow</span><span class=\"c4\">: </span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-2 start\"><li class=\"c2\"><span class=\"c4\">Sicherheitsma&szlig;nahmen verst&auml;rkt</span></li><li class=\"c2\"><span class=\"c4\">Sicherheitspersonal auf Alarmbereitschaft</span></li><li class=\"c2\"><span class=\"c4\">Experiment-Erlaubnis nur mit SD+</span></li><li class=\"c2\"><span>A-B Personal begibt sich in ihre B&uuml;ros</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1\"><li class=\"c12\"><span class=\"c1\">Red: </span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-2 start\"><li class=\"c2\"><span class=\"c4\">Sicherheitsma&szlig;nahmen verst&auml;rkt</span></li><li class=\"c2\"><span class=\"c4\">Zellentrakt abgeriegelt</span></li><li class=\"c2\"><span class=\"c4\">Jede D-Klasse in die Zelle</span></li><li class=\"c2\"><span class=\"c4\">A-B Personal begibt sich in den Bunker</span></li><li class=\"c2\"><span>striktes</span><span>&nbsp;</span><span>Experimentverbot</span><span>.</span></li></ul><p class=\"c10 c13\"><span class=\"c4\"></span></p><ul class=\"c9 lst-kix_ncmta49fr0iq-0\"><li class=\"c6\"><span class=\"c0\">Foundation Wissen (G&auml;nge, SCP Zellen, Zonen etc.)</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1 start\"><li class=\"c12\"><span class=\"c5 c19\"><a class=\"c26\" href=\"https://www.google.com/url?q=https://modern-gaming.net/forum/thread/26580-orientierungshilfe-area-14/&amp;sa=D&amp;ust=1603644865137000&amp;usg=AOvVaw0N4nUUnbFsa-bO892lKFcE\">https://modern-gaming.net/forum/thread/26580-orientierungshilfe-area-14/</a></span></li></ul></td></tr></tbody></table><p class=\"c10\"><span class=\"c1\"></span></p><p class=\"c10\"><span class=\"c1\"></span></p><p class=\"c10\"><span class=\"c1\"></span></p><p class=\"c10\"><span class=\"c1\"></span></p><a id=\"t.7ad760862340578b4c099509d4d4fd0fedc0efae\"></a><a id=\"t.1\"></a><table class=\"c25\"><tbody><tr class=\"c24\"><td class=\"c20\" colspan=\"1\" rowspan=\"1\"><p class=\"c23\"><span class=\"c5 c21\">Praktisches Wissen</span></p><p class=\"c15\"><span class=\"c1\"></span></p><ul class=\"c9 lst-kix_ncmta49fr0iq-0\"><li class=\"c6\"><span class=\"c0\">Schild f&uuml;hren</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1 start\"><li class=\"c12\"><span class=\"c0\">Richtiges halten eines Schildes</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-2 start\"><li class=\"c2\"><span class=\"c0\">Auf das Knie aufpassen</span></li><li class=\"c2\"><span class=\"c0\">Third-Person nicht ratsam, da man unbewusst nach unten schaut</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1\"><li class=\"c12\"><span class=\"c0\">Wie peeke ich um eine Ecke / in eine T&uuml;r</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-2 start\"><li class=\"c2\"><span class=\"c0\">Links nach Rechts; da das linke Knie oft der Schwachpunkt ist</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1\"><li class=\"c12\"><span class=\"c0\">Wie stelle ich mich hinter mein platziertes Schild?</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-2 start\"><li class=\"c2\"><span class=\"c0\">Offen dahinter stehen ist nur selten ratsam</span></li><li class=\"c2\"><span class=\"c0\">Oft ist crouched neben dem Schild stehen effektiver</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-3 start\"><li class=\"c14\"><span class=\"c0\">Kleinere Hitbox</span></li><li class=\"c14\"><span class=\"c0\">Off-Angle f&uuml;r den Gegner, da nicht Kopfh&ouml;he</span></li><li class=\"c14\"><span class=\"c0\">Wenn Gegner mit Schild pusht -&gt; leichter die Beine zu treffen</span></li></ul><p class=\"c10\"><span class=\"c0\"></span></p><ul class=\"c9 lst-kix_ncmta49fr0iq-0\"><li class=\"c6\"><span class=\"c0\">MTF Formationen</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1 start\"><li class=\"c12\"><span class=\"c0\">Kolonne</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-2 start\"><li class=\"c2\"><span class=\"c5\">Truppleiter am Anfang, danach 1er Reihen</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-1\"><li class=\"c12\"><span class=\"c0\">Feuerlinie</span></li></ul><ul class=\"c9 lst-kix_ncmta49fr0iq-2 start\"><li class=\"c2\"><span class=\"c5\">In einer Reihe aufstellen</span></li></ul></td></tr></tbody></table><p class=\"c10\"><span class=\"c1\"></span></p><p class=\"c10\"><span class=\"c0\"></span></p><p class=\"c10\"><span class=\"c1\"></span></p><p class=\"c10\"><span class=\"c1\"></span></p><p class=\"c10\"><span class=\"c1\"></span></p><p class=\"c10\"><span class=\"c1\"></span></p><p class=\"c10\"><span class=\"c4\"></span></p></div></body></html>', ''),
(2, 'PFC TO Lösungen', 'Dieses Dokument ist als Lösungsmuster für das PFC TO da', 'pfc_to_l', 6, 'Lösungsdokumente', '', ''),
(3, 'SGT TO Lösungen', 'Dieses Dokument ist als Lösungsmuster für das SGT TO da', 'sgt_to_l', 11, 'Lösungsdokumente', '', ''),
(4, '2Lt TO Lösungen', 'Dieses Dokument ist als Lösungsmuster für das 2Lt TO da', '2lt_to_l', 15, 'Lösungsdokumente', '', ''),
(5, 'PFC Ausbildungsfragen', 'Dieses Dokument beinhaltet die erforderlichen Informationen für das PFC TO', 'pfc_to', 1, 'Ausbildungsdokumente', '', ''),
(6, 'SGT Ausbildungsfragen', 'Dieses Dokument beinhaltet die erforderlichen Informationen für das SGT TO', 'sgt_to', 1, 'Ausbildungsdokumente', '', ''),
(7, '2Lt Ausbildungsfragen', 'Dieses Dokument beinhaltet die erforderlichen Informationen für das 2Lt TO', '2lt_to', 1, 'Ausbildungsdokumente', '', ''),
(8, 'MTF Regelwerk', 'Dies ist das Regelwerk der MTF, an das sich jeder zu halten hat', 'mtf_rules', 1, 'Andere Dokumente', '', ''),
(9, 'MTF Strafkatalog', 'Dies ist der Strafkatalog. Strafen werden entsprechend diesem Katalog vollzogen.', 'mtf_skl', 1, 'Andere Dokumente', '', ''),
(10, 'Orientierungshilfe', 'Hier findest du Hilfe zur Orientierung auf Area-14', 'orh', 1, 'Andere Dokumente', 'https://modern-gaming.net/forum/thread/26580-orientierungshilfe-area-14/', 'external');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mtf_einheiten`
--

CREATE TABLE `mtf_einheiten` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `info` text NOT NULL,
  `titel` text NOT NULL,
  `shortname` text NOT NULL,
  `url` text NOT NULL,
  `leitung` text NOT NULL,
  `coleitung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `mtf_einheiten`
--

INSERT INTO `mtf_einheiten` (`id`, `name`, `info`, `titel`, `shortname`, `url`, `leitung`, `coleitung`) VALUES
(1, 'Epsilon-6', 'Spezialisiert auf die Untersuchung, Eindämmung und anschließende Beseitigung von Anomalien in ländlichen und vorstädtischen Umgebungen.', 'Informationen zur Epsilon 6 \"Village Idiots\"', 'e6', '', 'STEAM_0:0:86232373', 'STEAM_0:1:100929417'),
(2, 'Nu-7', 'Die MTF-Unit Nu7 \"Hammerdown\" ist für das Einschreiten bei katastrophalen Ereignissen wie einem Kommunikatonsverlust oder einem Site-weiten Breach zuständig. Sie besitzt Bataillonsstärke und besteht aus verschiedensten Teilen.\r\nIn Area-14 ist sie als Heavy-Einheit eingeteilt, und bildet mit ihren schweren Schilden, schwerer Panzerung und ihren schweren Waffen die Frontlinie.\r\nAlternativ leisten sie mit ihren MGs Unterstützung.', 'Informationen zur MTF Nu-7 \"Hammer Down\"', 'n7', '', 'STEAM_0:1:169464330\r\n', 'STEAM_0:0:178850058'),
(3, 'Delta-5', 'Die Mobile Task Force Delta-5 besteht aus mehreren autonomen Deep-Cover-Zellen, die auf die Identifizierung und präventive Erfassung anomaler Objekte und Einheiten spezialisiert sind, die für andere Interessengruppen von Interesse sind.', 'Informationen zur MTF Delta-5 \"Front Runners\"', 'd5', '', 'STEAM_0:0:86232373', 'STEAM_0:1:425974519\r\n');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mtf_user`
--

CREATE TABLE `mtf_user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `steamid64` text NOT NULL,
  `steamid32` text NOT NULL,
  `avatarfull` text NOT NULL,
  `mg_profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `mtf_user`
--

INSERT INTO `mtf_user` (`id`, `name`, `url`, `steamid64`, `steamid32`, `avatarfull`, `mg_profile`) VALUES
(1, 'KiwontaTv', 'https://steamcommunity.com/id/KiwontaTv/', '76561198317965844', 'STEAM_0:0:178850058', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/00/00d1c29bdbd090995b64b2efb5a99ef5ca01a5be_full.jpg', 'https://modern-gaming.net/user/3902-kiwontatv/'),
(2, '!M1tsinn', 'https://steamcommunity.com/id/m1tsinn/', '76561198162124563', 'STEAM_0:1:100929417', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/fb/fb59a4659c64e27b66357f9a8c4333351ca04d6c_full.jpg', 'https://modern-gaming.net/user/4009-m1tsinn/'),
(3, '[MG] Lebswesen', 'https://steamcommunity.com/id/lebswesen/', '76561198280122641', 'STEAM_0:1:159928456', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/9b/9b0b721b77b2fb095afe7b38c584b942b5e4375e_full.jpg', 'https://modern-gaming.net/user/7970-lebswesen/'),
(4, 'Horny Liniu', 'https://steamcommunity.com/id/Liniu/', '76561198063119670', 'STEAM_0:0:51426971', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/fc/fc7d7b8e7f9da15fc416231b5df3dabc83c98955_full.jpg', 'https://modern-gaming.net/user/2336-liniu/'),
(5, 'GangstarBanane', 'https://steamcommunity.com/id/GangstarBanane/', '76561198299194389', 'STEAM_0:1:169464330', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/be/be32b763f3bb85e35df169ac67b657a382db2556_full.jpg', 'https://modern-gaming.net/user/7276-gangstarbanane/'),
(6, 'ϡ Sladti ϡ', 'https://steamcommunity.com/id/SladtiW/', '76561198176131425', 'STEAM_0:1:107932848', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/bb/bb01c6a5bdace055d413420341ff8e11e94a337e_full.jpg', 'https://modern-gaming.net/user/4643-sladti/'),
(7, 'Wobba', 'https://steamcommunity.com/id/MrWobba/', '76561198132730474', 'STEAM_0:0:86232373', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/c3/c31b6540cb7bf4a64bad153aa4b250419393300b_full.jpg', 'https://modern-gaming.net/user/2969-wobba/');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mysql_debug`
--

CREATE TABLE `mysql_debug` (
  `id` int(11) NOT NULL,
  `sql` text NOT NULL,
  `error` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `mtf_character`
--
ALTER TABLE `mtf_character`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `mtf_dokumente`
--
ALTER TABLE `mtf_dokumente`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `mtf_einheiten`
--
ALTER TABLE `mtf_einheiten`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `mtf_user`
--
ALTER TABLE `mtf_user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `mysql_debug`
--
ALTER TABLE `mysql_debug`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `mtf_character`
--
ALTER TABLE `mtf_character`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `mtf_dokumente`
--
ALTER TABLE `mtf_dokumente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `mtf_einheiten`
--
ALTER TABLE `mtf_einheiten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `mtf_user`
--
ALTER TABLE `mtf_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `mysql_debug`
--
ALTER TABLE `mysql_debug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
