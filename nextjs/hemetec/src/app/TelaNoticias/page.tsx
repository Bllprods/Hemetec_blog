"use client";
import React, { useEffect, useState } from "react";
import Link from "next/link";
import Header from "../components/Header";
import "../fonte.css";
import data from "../../../../../data.json";
 
export default function TelaNoticias() {
  const [noticias, setNoticias] = useState<any[]>([]);
  const [fadeInStates, setFadeInStates] = useState<boolean[]>([]);
  const [paginaAtual, setPaginaAtual] = useState(1);
  const [sortType, setSortType] = useState<"recent" | "old" | "alphabetical">("recent");
  const [transitioning, setTransitioning] = useState(false);
 
  const noticiasPorPagina = 10;
 
  useEffect(() => {
    setNoticias(data || []);
    setFadeInStates(new Array(data.length).fill(false));
 
    data.forEach((_, i) => {
      setTimeout(() => {
        setFadeInStates((prev) => {
          const copy = [...prev];
          copy[i] = true;
          return copy;
        });
      }, i * 100);
    });
  }, []);
 
  // Ordena as notícias conforme o filtro
  const noticiasOrdenadas = [...noticias].sort((a, b) => {
    if (sortType === "recent") return new Date(b.criado_em).getTime() - new Date(a.criado_em).getTime();
    if (sortType === "old") return new Date(a.criado_em).getTime() - new Date(b.criado_em).getTime();
    if (sortType === "alphabetical") return a.titulo.localeCompare(b.titulo);
    return 0;
  });
 
  const totalPaginas = Math.ceil(noticias.length / noticiasPorPagina);
 
  // Controle da transição de página
  const mudarPagina = (novaPagina: number) => {
    if (novaPagina === paginaAtual || transitioning) return;
    setTransitioning(true);
    setTimeout(() => {
      setPaginaAtual(novaPagina);
      setTransitioning(false);
    }, 400); // tempo de transição
  };
 
  // Notícias da página atual
  const inicio = (paginaAtual - 1) * noticiasPorPagina;
  const fim = inicio + noticiasPorPagina;
  const noticiasPagina = noticiasOrdenadas.slice(inicio, fim);
 
  return (
    <div>
      <Header onSortChange={(type) => { setSortType(type); setPaginaAtual(1); }} />
 
      <div id="Corpo" className="body-next" style={{ padding: "20px" }}>
        <h2 className="titulo-secundario-next">
          Acompanhe abaixo as últimas postagens publicadas:
        </h2>
 
        {/* Cards */}
        <div
          className="cards-posts"
          style={{
            display: "flex",
            flexWrap: "wrap",
            gap: "20px",
            justifyContent: "center",
            opacity: transitioning ? 0 : 1,
            transform: transitioning ? "scale(0.98)" : "scale(1)",
            transition: "opacity 0.4s ease, transform 0.3s ease",
          }}
        >
          {noticiasPagina.map((noticia, i) => (
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
                opacity: fadeInStates[i + inicio] ? 1 : 0,
                transform: fadeInStates[i + inicio] ? "translateY(0)" : "translateY(20px)",
                transition: "opacity 0.2s ease, transform 0.2s ease",
              }}
            >
              <h3 className="titulo-secundario-next" style={{ textAlign: "center", marginBottom: "10px" }}>
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
 
              <p style={{ fontSize: "13px", color: "#666", marginBottom: "15px", textAlign: "center" }}>
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
                  Ler mais
                </span>
              </Link>
            </article>
          ))}
        </div>
 
        {/* Paginação */}
        <div style={{ display: "flex", justifyContent: "center", gap: "8px", marginTop: "30px", flexWrap: "wrap" }}>
         
           
 
          {/* Bolinhas */}
          {Array.from({ length: totalPaginas }, (_, i) => (
            <button
              key={i}
              onClick={() => mudarPagina(i + 1)}
              style={{
                width: "32px",
                height: "32px",
                borderRadius: "50%",
                border: "none",
                background: paginaAtual === i + 1 ? "black" : "#ccc",
                color: paginaAtual === i + 1 ? "white" : "black",
                cursor: "pointer",
                fontWeight: "bold",
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
              }}
            >
              {i + 1}
            </button>
          ))}
 
        
          
        </div>
      </div>
    </div>
    
  );
}
