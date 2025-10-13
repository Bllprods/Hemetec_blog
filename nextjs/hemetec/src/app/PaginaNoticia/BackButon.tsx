'use client';
 
export default function BackButton() {
  return (
    <button
      onClick={() => history.back()}
      style={{
        marginTop: "20px",
        background: "black",
        color: "white",
        padding: "8px 16px",
        borderRadius: "10px",
        fontWeight: "bold",
        cursor: "pointer",
        alignSelf: "center",
        fontSize: "20px"
      }}
    >
      Voltar para Notícias
    </button>
  );
}
 