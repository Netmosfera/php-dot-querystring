DotQueryString
=============

This a typical PHP multi-dimensional query string:

```
hello[aaa][bbb]=10&hello[aaa][ccc]=10
```

Except that:

- It looks terrible in a web browser:
  <nobr>`mypage.php?hello%5Baaa%5D%5Bbbb%5D=10&hello%5Baaa%5D%5Bbbb%5D=10`</nobr>
- Its readability and the chances that the user can edit it manually are nil.
- It's a waste of bytes. Uses additional 6 bytes for each key.

This package provides a replacement format for query strings that uses dots as separators
instead of a pair of brackets `[]`.

```
hello.aaa.bbb=10&hello.aaa.ccc=10
```

It also works for forms:

| Current Method | `DotQueryString::decode()` Method |
| :---: | :---: |
| `<input type="text" name="users[10][name]">` | ` <input type="text" name="users.10.name">` |
| `<input type="text" name="users[][]">` | `<input type="text" name="users..">` |
| `<input type="text" name="foo[][test][]">` | `<input type="text" name="foo..test.">` |

## Before (1,648 bytes):

```
r%5B0%5D%5Bl%5D=OR&r%5B0%5D%5Bn%5D=0&r%5B0%5D%5Bc%5D=22&r%5B0%5D%5Bt%5D=111&r%5B0%5D%5Bv%5D=ssssssss&r%5B1%5D%5Bl%5D=AND&r%5B1%5D%5Bn%5D=0&r%5B1%5D%5Bc%5D=22&r%5B1%5D%5Bt%5D=111&r%5B1%5D%5Bv%5D=ddddddddd&r%5B2%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B0%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B0%5D%5Bn%5D=0&r%5B2%5D%5Bs%5D%5B0%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B0%5D%5Bt%5D=111&r%5B2%5D%5Bs%5D%5B0%5D%5Bv%5D=aaaaaaa&r%5B2%5D%5Bs%5D%5B1%5D%5Bl%5D=AND&r%5B2%5D%5Bs%5D%5B1%5D%5Bn%5D=1&r%5B2%5D%5Bs%5D%5B1%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B1%5D%5Bt%5D=333&r%5B2%5D%5Bs%5D%5B1%5D%5Bv%5D=&r%5B2%5D%5Bs%5D%5B2%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B2%5D%5Bn%5D=0&r%5B2%5D%5Bs%5D%5B2%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B2%5D%5Bt%5D=111&r%5B2%5D%5Bs%5D%5B2%5D%5Bv%5D=dddddddd&r%5B2%5D%5Bs%5D%5B3%5D%5Bl%5D=AND&r%5B2%5D%5Bs%5D%5B3%5D%5Bn%5D=0&r%5B2%5D%5Bs%5D%5B3%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B3%5D%5Bt%5D=111&r%5B2%5D%5Bs%5D%5B3%5D%5Bv%5D=&r%5B2%5D%5Bs%5D%5B4%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bn%5D=1&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bt%5D=333&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B0%5D%5Bv%5D=&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bl%5D=AND&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bn%5D=1&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bt%5D=333&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B1%5D%5Bv%5D=&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bl%5D=OR&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bn%5D=0&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bc%5D=22&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bt%5D=111&r%5B2%5D%5Bs%5D%5B4%5D%5Bs%5D%5B2%5D%5Bv%5D=sdfsdf&page=1&perPage=20
```

## After (668 bytes):

```
r.0.l=OR&r.0.n=0&r.0.c=22&r.0.t=111&r.0.v=ssssssss&r.1.l=AND&r.1.n=0&r.1.c=22&r.1.t=111&r.1.v=ddddddddd&r.2.l=OR&r.2.s.0.l=OR&r.2.s.0.n=0&r.2.s.0.c=22&r.2.s.0.t=111&r.2.s.0.v=aaaaaaa&r.2.s.1.l=AND&r.2.s.1.n=1&r.2.s.1.c=22&r.2.s.1.t=333&r.2.s.1.v=&r.2.s.2.l=OR&r.2.s.2.n=0&r.2.s.2.c=22&r.2.s.2.t=111&r.2.s.2.v=dddddddd&r.2.s.3.l=AND&r.2.s.3.n=0&r.2.s.3.c=22&r.2.s.3.t=111&r.2.s.3.v=&r.2.s.4.l=OR&r.2.s.4.s.0.l=OR&r.2.s.4.s.0.n=1&r.2.s.4.s.0.c=22&r.2.s.4.s.0.t=333&r.2.s.4.s.0.v=&r.2.s.4.s.1.l=AND&r.2.s.4.s.1.n=1&r.2.s.4.s.1.c=22&r.2.s.4.s.1.t=333&r.2.s.4.s.1.v=&r.2.s.4.s.2.l=OR&r.2.s.4.s.2.n=0&r.2.s.4.s.2.c=22&r.2.s.4.s.2.t=111&r.2.s.4.s.2.v=sdfsdf&page=1&perPage=20
```
