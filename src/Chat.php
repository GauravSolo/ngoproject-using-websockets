<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        // echo "server started";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        // echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        // echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        //     , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

            $data = json_decode($msg,true);
            $userid  = $data['userid'];
            $msg = $data['msg'];
            $sno = $data['sno'];


            // include "../config.php";
            $conn = mysqli_connect('localhost','root','12345','NGO');
            $host = 'http://localhost/ngoproject/';
            
            if($sno == -1)
            {
                $stime =  date("g:i A, M j");
                $sql1 = "INSERT INTO messages(msg_id,msg,stime) VALUE({$userid},'{$msg}','{$stime}')";
                mysqli_query($conn,$sql1) or die("couldnt ru--> query");
            }else{
                $sql2 = "DELETE FROM messages WHERE sno = {$sno}";
                mysqli_query($conn,$sql2) or die("couldntt run query--> delete msg");
            }

            $sql = "SELECT messages.sno,messages.msg_id,messages.msg,messages.stime,usersdata.image FROM messages INNER JOIN usersdata ON messages.msg_id = usersdata.user_id ORDER BY messages.sno ASC";
            $result = mysqli_query($conn,$sql) or die("couldnt run query --> app");            

            $res = "";
            while($row = mysqli_fetch_assoc($result))
            {
                if($row['msg_id'] == $userid)
                {
                    $active = "class='right'";
                    $times = "class='time-left'";
                    $darker = "darker";
                }
                else{
                    $darker = "";
                    $active = "";
                    $times = "class='time-right'";
                }
                if($row['msg_id'] == 1)
                {
                    $admin = '<span class="badge bg-secondary">Admin</span>';
                }else{
                    $admin = "";
                }
                $res = $res.'<div class="msgcontainer '.$darker.'">
                <img src="../upload/'.$row['image'].'" '.$active.'alt="Avatar">
                <p>'.$row['msg'].' '.
                $admin.'</p><span '.$times.'>'.$row['stime'].'</span>
              </div>';
            }

            $data['res'] = $res;

            
        foreach ($this->clients as $client) {
           
                $client->send(json_encode($data));

                
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        // echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        // echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}