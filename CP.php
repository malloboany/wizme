<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "venue";

$salt = "@#!wizmebymalloboany^&!#@";

function check_Sign_Up($Name, $Email, $Password, $RePassword) {
    if ($Name == 'NAME' || $Name == '')
        return 'You must enter your name!';
    if ($Email == 'EMAIL' || $Email == '')
        return 'You must enter your email';
    if ($Password == 'Password' || $Password == '')
        return 'You must enter password';
    if ($Password == 'Re Password' || $Password == '')
        return 'You must enter Re password';
    if ($Password != $RePassword)
        return 'Password does not match!';
    if (strlen($Password) < 8)
        return 'Password must be Longer!';
    return 'success';
}

function db_sign_up($name, $email, $password) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("SELECT * FROM user WHERE User_Email='" . $email . "'");
        $statement->execute();
        $row = $statement->fetch();
        if ($row && count($row) > 0) {
            return 'Email is exist!';
        } else {
            $statement = $db->prepare("INSERT INTO user (User_Name, User_Rule, User_Password, User_Email)"
                    . "VALUES (:name, :rule, :pass, :email)");
            $statement->execute(array(
                'name' => $name,
                'rule' => 2,
                'pass' => $password,
                'email' => $email)
            );
            $id = $db->lastInsertId();
            $statement2 = $db->prepare("INSERT INTO create_req (Create_Req_VenueID, Create_Req_Time )"
                    . "VALUES (:ven, :time)");
            $statement2->execute(array(
                'ven' => $id,
                'time' => time())
            );            
            return 'success';
        }
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function check_Sign_In($email, $password) {
    if ($email == 'Email' || $email == '')
        return 'You must enter your email';
    if ($password == 'Password' || $password == '')
        return 'You must enter password';
    return 'success';
}

function db_sign_in($email, $password) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("SELECT * FROM user WHERE User_Email='" . $email . "' "
                . "AND User_Password='" . $password . "'");
        $statement->execute();
        $row = $statement->fetch();
        if ($row && count($row) > 0) {
            return $row;
        } else {
            return 0;
        }
    } catch (Exception $ex) {
        return 0;
    }
}

function db_get_kinds() {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("SELECT * FROM kind");
        $statement->execute();
        $row = $statement->fetchAll();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    } catch (Exception $ex) {
        return 0;
    }
}

function Check_Create_Venue($name, $price, $adress, $phone) {
    return 'success';
}

function db_Create_Venue($name, $kind, $manager, $price, $address, $phone) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("INSERT INTO venue (Venue_Name , Venue_Kind ,"
                . " Venue_Price , Venue_Manager,Venue_Address ,Venue_Phone  )"
                . "VALUES (:name, :kind, :price, :manager, :address, :phone)");
        $statement->execute(array(
            'name' => $name,
            'kind' => $kind,
            'price' => $price,
            'manager' => $manager,
            'address' => $address,
            'phone' => $phone,
                )
        );
        $id = $db->lastInsertId();
        //$row = $statement->fetchColumn(0);

        $statement2 = $db->prepare("INSERT INTO create_req (Create_Req_VenueID  , Create_Req_Time )"
                . "VALUES (:venue, :time)");
        $statement2->execute(array(
            'venue' => $id,
            'time' => time()
                )
        );

        return 'success';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function db_get_venues($venue_manager_id = NULL) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        if ($venue_manager_id == NULL) {
            $statement = $db->prepare("SELECT * FROM venue WHERE Venue_Active=1");
        } else {
            $statement = $db->prepare("SELECT * FROM venue WHERE Venue_Manager=" . $venue_manager_id);
        }

        $statement->execute();
        $row = $statement->fetchAll();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    } catch (Exception $ex) {
        return 0;
    }
}

function db_get_kind_name($id) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("SELECT * FROM kind WHERE Kind_ID =" . $id);
        $statement->execute();
        $row = $statement->fetch();
        if ($row) {
            return $row['Kind_Name'];
        } else {
            return 'Unknown';
        }
    } catch (Exception $ex) {
        return 'Unknown';
    }
}

function db_delete_venue($id) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("DELETE FROM create_req WHERE Create_Req_VenueID =" . $id
                . ";DELETE FROM venue WHERE Venue_ID =" . $id);
        $statement->execute();
    } catch (Exception $ex) {
        
    }
}

function db_get_venues_req() {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("SELECT * FROM create_req , venue WHERE Create_Req_VenueID = Venue_ID ");
        $statement->execute();
        $row = $statement->fetchAll();
        if ($row) {
            return $row;
        } else {
            return FALSE;
        }
    } catch (Exception $ex) {
        return FALSE;
    }
}

function db_get_User_Of_Venue($venue_id) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("SELECT * FROM user,venue WHERE User_ID = Venue_Manager AND Venue_ID = " . $venue_id);
        $statement->execute();

        return $statement->fetch();
    } catch (Exception $ex) {
        return FALSE;
    }
}

function db_send_accept_email($id) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $user = db_get_User_Of_Venue($id);
        $statement = $db->prepare("INSERT INTO email (Email_Receiver , Email_Content, Email_Time)"
                . "VALUES (:rec, :cont, :time)");
        $statement->execute(array(
            'rec' => $user['User_Email'],
            'cont' => "Your venue have been activated successfully in Wizme.com \n Thank you for your choice.",
            'time' => time())
        );
        return 'success';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function db_delete_venue_req($id) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("DELETE FROM create_req WHERE Create_Req_VenueID =" . $id
                . ";UPDATE venue SET Venue_Active = 1 Where Venue_ID = " . $id);
        $statement->execute();
        db_send_accept_email($id);
    } catch (Exception $ex) {
        
    }
}

function db_get_venue($id) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("SELECT * FROM venue WHERE Venue_ID=" . $id);


        $statement->execute();
        $row = $statement->fetch();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    } catch (Exception $ex) {
        return 0;
    }
}

function db_check_book($name, $from, $to, $email, $phone) {
    return 'success';
}

function db_book($name, $from, $to, $email, $phone, $VENUE) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("INSERT INTO booking (Booking_VenueID , Booking_Name ,"
                . " Booking_From  , Booking_To ,Booking_Email  ,Booking_Phone   )"
                . "VALUES (:ven, :name, :from, :to, :email, :phone)");
        $statement->execute(array(
            'ven' => $VENUE['Venue_ID'],
            'name' => $name,
            'from' => time(), //$from,
            'to' => time(), //$to,
            'email' => $email,
            'phone' => $phone
                )
        );
        $id = $db->lastInsertId();
        //$row = $statement->fetchColumn(0);

        $statement2 = $db->prepare("INSERT INTO booking_req (Booking_Req_BookingID   , Booking_Req_Time  )"
                . "VALUES (:book, :time)");
        $statement2->execute(array(
            'book' => $id,
            'time' => time()
                )
        );

        return 'success';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function db_get_bookings($ID) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("SELECT Booking_Req_ID, Booking_Req_BookingID, Booking_VenueID, Venue_Manager,Booking_Name, Booking_From, Booking_To, Booking_Email, Booking_Phone, Booking_Active, Venue_Name, Venue_ID, Booking_ID
            FROM booking, booking_req, venue
            WHERE Booking_Req_BookingID = Booking_ID
            AND Booking_VenueID = Venue_ID
            AND Venue_Manager = $ID");
        $statement->execute();

        return $statement->fetchAll();
    } catch (Exception $ex) {
        return 0;
    }
}

function db_send_accept_book_email($rec) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        //  $user = db_get_User_Of_Venue($id);
        $statement = $db->prepare("INSERT INTO email (Email_Receiver , Email_Content, Email_Time)"
                . "VALUES (:rec, :cont, :time)");
        $statement->execute(array(
            'rec' => $rec,
            'cont' => "Your Booking have been accepted successfully in Wizme.com \n Thank you for your choice.",
            'time' => time())
        );
        return 'success';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function db_accept_booking($value) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("DELETE FROM booking_req WHERE Booking_Req_ID  =" . $value['Booking_Req_ID']
                . ";UPDATE booking SET Booking_Active  = 1 Where Booking_ID  = " . $value['Booking_ID']);
        $statement->execute();
        db_send_accept_book_email($value['Booking_Email']);
    } catch (Exception $ex) {
        return 0;
    }
}

function db_send_message($mName, $mEmail, $mMessage) {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("INSERT INTO message (Message_Name , Message_Email , Message_Content )"
                . "VALUES (:name, :email, :cont)");
        $statement->execute(array(
            'name' => $mName,
            'email' => $mEmail,
            'cont' => $mMessage)
        );
        return 'success';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function db_get_messages() {
    global $dbname;
    global $dbuser;
    global $dbhost;
    global $dbpass;
    try {
        $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        $statement = $db->prepare("SELECT * FROM message");
        $statement->execute();
        return $statement->fetchAll();
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
