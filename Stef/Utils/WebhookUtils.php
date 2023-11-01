<?php

namespace Stef\Utils;

use CortexPE\DiscordWebhookAPI\Embed;
use CortexPE\DiscordWebhookAPI\Message;
use CortexPE\DiscordWebhookAPI\Webhook;

class WebhookUtils
{
	private const JOIN_URL = "https://discord.com/api/webhooks/1168274889363427490/Gh38cBdKChT9KfhqxB24h4djPJKK6gaF8TNGNqKEoL9GggbBZuHWXlJSKPwJZJj54wLZ";
	private const QUIT_URL = "https://discord.com/api/webhooks/1168274889363427490/Gh38cBdKChT9KfhqxB24h4djPJKK6gaF8TNGNqKEoL9GggbBZuHWXlJSKPwJZJj54wLZ";
	private const CHAT_URL = "https://discord.com/api/webhooks/1168275070590914670/3DfTS7MTVlICmXEu0Nw04zzzHPEdn1kx6qVejPXLTUR1DPPdN_wvU0jNZpCb1DxGRRvP";
	private const COMMAND_URL = "https://discord.com/api/webhooks/1168283739000930464/YnWdmLg7-K62Oa_JckWfMexHG86RP9KsEaaoJMLIn0DF8xd9Q8Jpc4pUWcLM5CddDAWx";
	private const PACKET_RECIEVE_URL = "https://discord.com/api/webhooks/1168275478331801630/g2qLByixI8ixRuodU_lRmAuxH5nLxejzXG_4OtX2LNXJXmYWCUpdYBbY0uZUzXFSrGAf";
	private const SRV_START_URL = "https://discord.com/api/webhooks/1168274889363427490/Gh38cBdKChT9KfhqxB24h4djPJKK6gaF8TNGNqKEoL9GggbBZuHWXlJSKPwJZJj54wLZ";
	private const SRV_STOP_URL = "https://discord.com/api/webhooks/1168274889363427490/Gh38cBdKChT9KfhqxB24h4djPJKK6gaF8TNGNqKEoL9GggbBZuHWXlJSKPwJZJj54wLZ";
	private const CHEAT_URL = "https://discord.com/api/webhooks/1168316322900349068/F-aSy41ZKjWMA4KB3DobV_z82AqStX1oOGMM12Ux6MDzxI3C35u8PdPOGOO25O6JXSMV";
	private const MODS_URL = "https://discord.com/api/webhooks/1168870683653181481/n9W7kKcpjel6sZ9a0JCyaGnhmkJ9dPFgz5P8S4VJOuz604XIysiDRchXWc2U3vliSlia";
	private static Webhook $w;
	public static function JoinLog(string $message){
		self::$w = new Webhook(self::JOIN_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("join logs");
		$embed = new Embed();
		$embed->setTitle("Join logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function QuitLog(string $message){
		self::$w = new Webhook(self::QUIT_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("quit logs");
		$embed = new Embed();
		$embed->setTitle("Quit logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function ChatLog(string $message){
		self::$w = new Webhook(self::CHAT_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("chat logs");
		$embed = new Embed();
		$embed->setTitle("chat logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function CommandsLog(string $message){
		self::$w = new Webhook(self::COMMAND_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("command logs");
		$embed = new Embed();
		$embed->setTitle("command logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function SrvStart(string $message){
		self::$w = new Webhook(self::SRV_START_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("Status logs");
		$embed = new Embed();
		$embed->setTitle("status logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function SrvStop(string $message){
		self::$w = new Webhook(self::SRV_STOP_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("status logs");
		$embed = new Embed();
		$embed->setTitle("status logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function Packet_recieve(string $message){
		self::$w = new Webhook(self::PACKET_RECIEVE_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("packet logs");
		$embed = new Embed();
		$embed->setTitle("packet logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function Nuke(string $message){
		self::$w = new Webhook(self::CHEAT_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("nuke logs");
		$embed = new Embed();
		$embed->setTitle("nuke logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function Mute(string $message){
		self::$w = new Webhook(self::MODS_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("mute logs");
		$embed = new Embed();
		$embed->setTitle("mute logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function Ban(string $message){
		self::$w = new Webhook(self::MODS_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("ban logs");
		$embed = new Embed();
		$embed->setTitle("ban logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
	public static function Kick(string $message){
		self::$w = new Webhook(self::MODS_URL);
		$w = self::$w;
		$msg = new Message();
		$msg->setUsername("kick logs");
		$embed = new Embed();
		$embed->setTitle("kick logs");
		$embed->setDescription($message);
		$msg->addEmbed($embed);
		$w->send($msg);
	}
}