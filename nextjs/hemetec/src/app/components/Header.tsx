"use client";
import React from "react";
import Head from "next/head";
import LogoImg from "../../imagens/logo.jpg";
import BannerImg from "../../imagens/Banner.png";
import "../../css/Home.css";
import "../../css/Cabecario.css";
import "../../css/Cores.css";
 
// ✅ Importando BackButton2 corretamente
import BackButton from "../PaginaNoticia/[id]/BackButton";
 
interface HeaderProps {
  onSortChange: (sortType: "recent" | "old" | "alphabetical") => void;
}
 
export default function Header({ onSortChange }: HeaderProps) {
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
            src={LogoImg.src}
            alt="Logo"
            title="Logo"
            id="Logo"
            width={150}
            height={150}
          />
 
          {/* Botão Voltar e Dropdown */}
          <div
            className="botoes"
            style={{
              display: "flex",
              alignItems: "center",
              gap: "10px",
            }}
          >
            <BackButton /> {/* ✅ Botão funcionando */}
          </div>
 
          <select
            id="filtroNoticias"
            onChange={(e) =>
              onSortChange(
                e.target.value as "recent" | "old" | "alphabetical"
              )
            }
            style={{
              padding: "8px 12px",
              borderRadius: "8px",
              border: "1px solid #ccc",
              cursor: "pointer",
              fontSize: "14px",
            }}
          >
            <option value="recent">Mais novas</option>
            <option value="old">Mais antigas</option>
            <option value="alphabetical">Ordem alfabética</option>
          </select>
        </div>
 
        {/* Banner */}
        <div
          id="Banner"
          style={{
            backgroundImage: `url(${BannerImg.src})`,
            height: "180px",
            backgroundSize: "cover",
            backgroundPosition: "center",
            borderRadius: "8px",
            marginTop: "10px",
          }}
        ></div>
      </div>
    </>
  );
}
 