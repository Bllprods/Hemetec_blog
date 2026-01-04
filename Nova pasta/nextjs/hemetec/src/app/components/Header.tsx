"use client";
 
import React, { useEffect, useState } from "react";
import Link from "next/link";
import Head from "next/head";
import "../../css/Home.css";
import "../../css/Cabecario.css";
import "../../css/Cores.css";
 
interface UserSession {
  nome?: string;
  email?: string;
  idAdm?: number;
}
 
export default function Header() {
  const [user, setUser] = useState<UserSession | null>(null);
  const [loading, setLoading] = useState(true);
  const [menuOpen, setMenuOpen] = useState(false);
 
  // Fetch da sessão do usuário
  useEffect(() => {
    fetch("/api/session")
      .then((res) => res.json())
      .then((data) => {
        if (data.nome) setUser(data);
        setLoading(false);
      })
      .catch((err) => {
        console.error(err);
        setLoading(false);
      });
  }, []);
 
  const toggleMenu = () => setMenuOpen(!menuOpen);
 
  const handleClickOutside = (e: MouseEvent) => {
    const menuBtn = document.getElementById("menuBtn");
    const popupMenu = document.getElementById("popupMenu");
    if (
      menuBtn &&
      popupMenu &&
      !menuBtn.contains(e.target as Node) &&
      !popupMenu.contains(e.target as Node)
    ) {
      setMenuOpen(false);
    }
  };
 
  useEffect(() => {
    window.addEventListener("click", handleClickOutside);
    return () => window.removeEventListener("click", handleClickOutside);
  }, []);
 
  return (
    <>
      <Head>
        <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        />
      </Head>
 
      <div id="Corpo">
        <div id="Cabecario">
          {/* Logo */}
          <img
          
            width={300}
            height={300}
            alt=""
            title=""
            id="Logo"
          />
 
          {/* Sessão / Botão Entrar */}
          <div>
            {!loading && (user ? (
              <>
                
                <div className="botoes">
                  <div
                    id="popupMenu"
                    style={{ display: menuOpen ? "block" : "none" }}
                  >
                    <Link href="http://localhost/a/public/router.php">Home</Link>

                  </div>
                  <button id="menuBtn" onClick={toggleMenu}>
                    <h1 style={{ fontSize: '15px'}}>Entrar</h1>
                  </button>
                </div>
              </>
            ) : (
              <Link href="/router?action=login" id="btnEntrar">
                Entrar
              </Link>
            ))}
          </div>
 
          <div id="Banner"></div>
        </div>
      </div>
    </>
  );
}
 