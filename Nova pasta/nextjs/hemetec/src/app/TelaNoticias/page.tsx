"use client";
import React, { useEffect, useState } from "react";
import Link from "next/link";
import Header from "../components/Header"; // Header integrado
import '../fonte.css';
import data from "../../../../../data.json"; // JSON local
 
export default function TelaNoticias() {
  const [noticias, setNoticias] = useState<any[]>([]);
  const [fadeInStates, setFadeInStates] = useState<boolean[]>([]);
 
  useEffect(() => {
    setNoticias(data || []);
    setFadeInStates(new Array(data.length).fill(false));
 
    // Fade-in progressivo
    data.forEach((_, i) => {
      setTimeout(() => {
        setFadeInStates(prev => {
          const copy = [...prev];
          copy[i] = true;
          return copy;
        });
      }, i * 100); // atraso de 100ms entre os cards
    });
  }, []);
 
  return (
    <div>
      <Header />
 
      <div id="Corpo" className="body-next" style={{ padding: '20px' }}>
        <h2 className="titulo-secundario-next">
          Acompanhe abaixo as últimas postagens publicadas:
        </h2>
 
        <div
          className="cards-posts"
          style={{
            display: "flex",
            flexWrap: "wrap", // cards lado a lado e quebram linha
            gap: "20px",
            justifyContent: "center", // centralizado horizontalmente
          }}
        >
          {noticias.map((noticia, i) => (
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
                border: "2px solid black", // borda preta
                opacity: fadeInStates[i] ? 1 : 0,
                transform: fadeInStates[i] ? 'translateY(0)' : 'translateY(20px)',
                transition: 'opacity 0.5s ease, transform 0.5s ease',
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
                  loading="lazy"
                />
              )}
 
              <p
                style={{
                  fontSize: "13px",
                  color: "#666",
                  marginBottom: "15px",
                  textAlign: "center",
                }}
              >
                Publicado em {new Date(noticia.criado_em).toLocaleDateString("pt-BR")} por {noticia.autor}
              </p>
 
              <Link href={`/PaginaNoticia/${noticia.id_noticia}?fromTela=1`}>
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
    </div>
  );
}
 