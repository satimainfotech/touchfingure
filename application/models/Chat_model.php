<?php 
class Chat_model extends CI_Model
{
    public function getMessages($sender_id, $receiver_id)
    {
        $this->db->where("(sender_id = $sender_id AND receiver_id = $receiver_id) OR (sender_id = $receiver_id AND receiver_id = $sender_id)");
        $query = $this->db->get('chat_messages');
        return $query->result();
    }

    public function insertMessage($data)
    {
        $this->db->insert('chat_messages', $data);
    }
}
