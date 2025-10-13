"use client";
import '../fonte.css'; // seu CSS de fontes
import React from "react";

import data from "../../../../../data.json"; // ajuste conforme sua estrutura
import Link from "next/link";
 
export default function TelaNoticias() {
  const noticias = data; // array direto do JSON
 
  return (
    <div id="Corpo" className="body-next">
      <h1 className="titulo-next">Notícias</h1>
      <h2 className="titulo-secundario-next">
        Acompanhe abaixo as últimas postagens publicadas:
      </h2>
 
      <div
        className="cards-posts"
        style={{ gap: "20px", flexWrap: "wrap", justifyContent: "center" }}
      >
        {noticias.map((noticia) => (
          <article
            key={noticia.id_noticia}
            style={{
              flex: "1 1 300px",
              maxWidth: "350px",
              background: "#fff",
              borderRadius: "15px",
              padding: "20px",
              boxShadow: "0 4px 8px rgba(0,0,0,0.1)",
              display: "flex",
              flexDirection: "column",
              alignItems: "center",
              transition: "transform 0.2s",
            }}
          >
            <h3
              className="titulo-secundario-next"
              style={{ textAlign: "center", marginBottom: "10px" }}
            >
              {noticia.titulo}
            </h3>
 
            {noticia.imagens?.length > 0 && (
              <img
                src={noticia.imagens[0]}
                alt={noticia.titulo}
                style={{
                  width: "100%",
                  height: "180px",
                  objectFit: "cover",
                  borderRadius: "12px",
                  marginBottom: "15px",
                }}
              />
            )}
 
            <p
              className="body-next"
              style={{
                fontSize: "13px",
                color: "#666",
                marginBottom: "15px",
                textAlign: "center",
              }}
            >
              Publicado em{" "}
              {new Date(noticia.criado_em).toLocaleDateString("pt-BR")} por{" "}
              {noticia.autor}
            </p>
 
            <Link
              href={`/PaginaNoticia?id=${noticia.id_noticia}&fromTela=1`}
            >
              <span
                style={{
                  background: "black",
                  color: "white",
                  padding: "8px 16px",
                  borderRadius: "8px",
                  fontWeight: "bold",
                  fontSize: "14px",
                  cursor: "pointer",
                  display: "inline-block",
                }}
              >
                Ler mais →
              </span>
            </Link>
          </article>
        ))}
      </div>
    </div>
  );
}
 