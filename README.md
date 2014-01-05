parse_dot_str
=============

    hello[aaa][bbb]=10&hello[aaa][ccc]=10

That's a regular php multidimensional querystring; looks pretty fine until you realize that

- they look ghastly in a web browser: `mypage.php?hello%5Baaa%5D%5Bbbb%5D=10&hello%5Baaa%5D%5Bbbb%5D=10`
- readability and chances the user can edit them manually are nil
- that's a waste of bytes: 6 bytes each key, querystring length is usually limited by web servers

So I wrote this simple function that cames as a replacement for php's `parse_str`

    hello.aaa.bbb=10&hello.aaa.ccc=10

I believe this is perfect for php since you aren't allowed to use `.` in url keys in any way

- querystring isn't awful anymore since dot doesn't need to be escaped: `mypage.php?hello.aaa.bbb=10&hello.aaa.ccc=10`
- readability and editability are much improved 
- instead of 6 bytes for each key, you will use just one single byte

So if you have...

    <input type="text" name="users[10][name]">

... you will just need to change it to

    <input type="text" name="users.10.name">

... and if you have ...

    <input type="text" name="users[][]">
    
... you just have to write ...

    <input type="text" name="users..">

=======

**Implementation is a bit of a disaster at the moment but I believe it is "good enough"... feel free to suggest improvements!**

TODO: a `http_build_query` equivalent for this syntax

=======

Before (1,648 bytes):

    r%5B0%5D%5Bl%5D=OR&r%5B0%5D%5Bn%5D=0&r%5B0%5D%5Bc%5D=22&r%5B0%5D%5Bt%5D=111&r%5B0%5D%5Bv%5D=ssssssss&r%5B1%5D%5Bl%5D=AND&r%5B1%5D%5Bn%5D=0&r%5B1%5D%5Bc%5D=22&r%5B1%5D%5Bt%5D=111&r%5B1%5D%5Bv%5D=ddddddddd&r%5B2%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B0%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B0%5D%5Bn%5D=0&r%5B2%5D%5Bs%5D%5B0%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B0%5D%5Bt%5D=111&r%5B2%5D%5Bs%5D%5B0%5D%5Bv%5D=aaaaaaa&r%5B2%5D%5Bs%5D%5B1%5D%5Bl%5D=AND&r%5B2%5D%5Bs%5D%5B1%5D%5Bn%5D=1&r%5B2%5D%5Bs%5D%5B1%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B1%5D%5Bt%5D=333&r%5B2%5D%5Bs%5D%5B1%5D%5Bv%5D=&r%5B2%5D%5Bs%5D%5B2%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B2%5D%5Bn%5D=0&r%5B2%5D%5Bs%5D%5B2%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B2%5D%5Bt%5D=111&r%5B2%5D%5Bs%5D%5B2%5D%5Bv%5D=dddddddd&r%5B2%5D%5Bs%5D%5B3%5D%5Bl%5D=AND&r%5B2%5D%5Bs%5D%5B3%5D%5Bn%5D=0&r%5B2%5D%5Bs%5D%5B3%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B3%5D%5Bt%5D=111&r%5B2%5D%5Bs%5D%5B3%5D%5Bv%5D=&r%5B2%5D%5Bs%5D%5B4%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bn%5D=1&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bt%5D=333&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bv%5D=&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bl%5D=AND&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bn%5D=1&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bt%5D=333&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bv%5D=&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bn%5D=0&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bt%5D=111&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bv%5D=sdfsdf&page=1&perPage=20

After (668 bytes):

    r.0.l=OR&r.0.n=0&r.0.c=22&r.0.t=111&r.0.v=ssssssss&r.1.l=AND&r.1.n=0&r.1.c=22&r.1.t=111&r.1.v=ddddddddd&r.2.l=OR&r.2.s.0.l=OR&r.2.s.0.n=0&r.2.s.0.c=22&r.2.s.0.t=111&r.2.s.0.v=aaaaaaa&r.2.s.1.l=AND&r.2.s.1.n=1&r.2.s.1.c=22&r.2.s.1.t=333&r.2.s.1.v=&r.2.s.2.l=OR&r.2.s.2.n=0&r.2.s.2.c=22&r.2.s.2.t=111&r.2.s.2.v=dddddddd&r.2.s.3.l=AND&r.2.s.3.n=0&r.2.s.3.c=22&r.2.s.3.t=111&r.2.s.3.v=&r.2.s.4.l=OR&r.2.s.4.s.0.l=OR&r.2.s.4.s.0.n=1&r.2.s.4.s.0.c=22&r.2.s.4.s.0.t=333&r.2.s.4.s.0.v=&r.2.s.4.s.1.l=AND&r.2.s.4.s.1.n=1&r.2.s.4.s.1.c=22&r.2.s.4.s.1.t=333&r.2.s.4.s.1.v=&r.2.s.4.s.2.l=OR&r.2.s.4.s.2.n=0&r.2.s.4.s.2.c=22&r.2.s.4.s.2.t=111&r.2.s.4.s.2.v=sdfsdf&page=1&perPage=20

