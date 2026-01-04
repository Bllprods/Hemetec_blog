// nextjs/hemetec/src/app/PaginaNoticia/[id]/BackButton.tsx
"use client";
 
import { useRouter } from "next/navigation";
import { useState } from "react";
 
export default function BackButton() {
  const router = useRouter();
  const [isClicked, setIsClicked] = useState(false);
 
  const handleVoltar = () => {
    // 1️⃣ inicia animação
    setIsClicked(true);
 
    // 2️⃣ navegação imediata
    router.push("/TelaNoticias");
  };
 
  return (
    <button
      onClick={handleVoltar}
      style={{
        padding: "10px 20px",
        borderRadius: "8px",
        background: isClicked ? "#333" : "#000",
        color: "#fff",
        fontWeight: "bold",
        cursor: "pointer",
        transition: "all 0.2s ease", // animação suave
        alignSelf: "flex-start",
      }}
    >
      ← Voltar
    </button>
  );
}
 