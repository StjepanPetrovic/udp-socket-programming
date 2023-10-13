# UDP Socket programming in PHP

The solution was developed using the PHP programming language, which has built-in functions for working with sockets, and the functions I used are:

`socket_create` https://www.php.net/manual/en/function.socket-create.php

`socket_bind` https://www.php.net/manual/en/function.socket-bind.php

`socket_strerror` https://www.php.net/manual/en/function.socket-strerror.php

`socket_last_error` https://www.php.net/manual/en/function.socket-last-error.php

`socket_recvfrom` https://www.php.net/manual/en/function.socket-recvfrom.php

`socket_sendto` https://www.php.net/manual/en/function.socket-sendto.php

The object-oriented source code is written in the following files:

- UdpSocket.php, which contains the main logic for creating and closing sockets, as well as reading and writing to the socket.
- Server.php, which will be executed and act as the server.
- Client.php, which will be executed and act as the client.

The server and client communicate by exchanging messages entered via the terminal. The process involves waiting for user input on the client, which is then sent to the server after confirmation. The server receives the message and displays it in the terminal, and then it waits for the user's input, which will be sent to the client.

To test this, you need to open one terminal and run the command "php Server.php" and in another terminal, run "php Client.php." This way, you can exchange messages between the server and the client.
